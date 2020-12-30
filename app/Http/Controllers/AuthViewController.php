<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SignUpRequest;

use App\Http\Requests\LoginRequest;

use App\Models\User;

use App\Models\Party;

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

    public function postLoad(Request $request){
    	$this->validate($request,[
    	   'url'=> 'required|url',
    	]);
      $rawUrl = substr($request['url'], strpos($request['url'], "=") + 1);

      //$party= Party

    	return redirect()->route('load',['id'=>$rawUrl]);
    }
    
    public function getLoad($id){
        
      return view('watch')->with('id',$id);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('signin');
    }
    

}
