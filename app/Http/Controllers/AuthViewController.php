<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SignUpRequest;

use App\Http\Requests\LoginRequest;

use App\Models\User;

use App\Models\Party;

use App\Models\Message;

use App\Events\StartSession;

use App\Events\NewMessage;

use Illuminate\Support\Facades\Route;

use Auth;

use Session;

use Laravel\Socialite\Facades\Socialite;

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
        "provider"=>0,
        "github_id"=>0,
        

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

      $party_id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 9).Auth::user()->id;



      $party= Auth::user()->sessions()->create(
          [
            'party_id'=>$party_id,
            'status'=>0,
            'url'=>$rawUrl
          ]
      );


      if ($party) {
        return redirect()->route('parties',['url'=>$party->party_id]);
      }
      else{
        return "error";
      }

      //https://protected-hollows-74005.herokuapp.com/sessions/Iql-f33u2W

    }

    public function getparties($url){

      $session= Party::where('party_id','=',$url)->with('user')->first();

      event(new StartSession($session));



      return view('watch',['session'=>$session]);

    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('signin');
    }

    public function getMessages(Party $session){
      return response()->json($session->messages()->with('user')->get());
    }

    public function sendMessage(Request $request, Party $session){

             $message = $session->messages()->create([

                    'content' => $request->content,

                    'user_id' => Auth::user()->id

              ]);


            $NewMessage = Message::where('id', $message->id)->first();


            broadcast(new NewMessage($NewMessage))->toOthers();

            return $NewMessage->toJson();


    }


    public function redirect($provider){

        return Socialite::driver($provider)->redirect();

    }

    public function callback($provider)

    {

        //$getInfo = Socialite::driver($provider)->user();
         $getInfo=Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getInfo,$provider);
        Auth::login($user);
        return redirect()->route('dashboard');

    }

    function createUser($getInfo,$provider){

        $user = User::where('github_id', $getInfo->id)->first();

        if (!$user) {

            $fullname = explode(" ", $getInfo->name);

            if (count($fullname)<2) {
                $username= $fullname[0];
            }
            else{
              $username=$fullname[1];
            }
           
            $user = User::create([

                'name'     => $getInfo->name,

                'email'    => $getInfo->email,

                'provider' => $provider,

                'github_id' => $getInfo->id,

                'password' => bcrypt('123456dummy'),

                'username'=>$username

            ]);

        }
        return $user;

    }




}














