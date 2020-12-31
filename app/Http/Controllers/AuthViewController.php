<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SignUpRequest;

use App\Http\Requests\LoginRequest;

use App\Models\User;

use App\Models\Party;

use Illuminate\Support\Facades\Route;

use Auth;

use Session;
class AuthViewController extends Controller
{
    
    public function getRegister(){
      return view('add');
    }


     public function getLogin(){
      return view('login');
    }

    public function getSignup(SignUpRequest $request){
      $user=User::create([
        "name"=>$request['fullname'],
        "email"=>$request['email'],
        "password"=>bcrypt($request['password']),
        "username"=>$request['username'],
      ]);
    Session::flash('message','Accounted Created Successfully');
    return back();
    }

  public function getPostLogin(LoginRequest $request){
        
      $credentials= ['email'=>$request['email'],'password'=>$request['password']];

      $errorType=false;
    
    if (Auth::attempt($credentials)) {
        return redirect()->route('dashboard');
        
      }
      else{
        Session::flash('message','Log in Failed');
        
        return back();
      }
    }

    public function getDashboard(){
      return view('dashboard');
    }

    public function postparties(Request $request){
      $this->validate($request,[
         'url'=> 'required|url',
      ]);
      $rawUrl = substr($request['url'], strpos($request['url'], "=") + 1);

      $party_id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 9);

      $party= Party::create(
          [
            'party_id'=>$party_id,
            'creator'=>Auth::user()->id,
            'status'=>0,
            'url'=>$rawUrl
          ]
      );

      
      if ($party) {
        return redirect()->route('parties',['url'=>$party->url]);
      }
      else{
        return "error";
      }

      //https://protected-hollows-74005.herokuapp.com/sessions/Iql-f33u2W
      
    }
    
    public function getparties($url){
      $party=Party::where('url','=',$url)->first();
      return view('watch',['party'=>$party]);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('signin');
    }
    

}
