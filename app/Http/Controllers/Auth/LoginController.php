<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


// login voi fb va google

      public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user= Socialite::driver('google')->stateless()->user();
        
        $authUser= $this->findOrCreateUser($user);
       Auth::login($authUser,true);
        return redirect($this->redirectTo);
    }


     public function findOrCreateUser($user)
    {
        $authUser = Customer::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => 'google',
            'provider_id' => $user->id
        ]);
    }
    // dang nhap-khach hang
    public function customerLogin(Request $request)
    {
        $username= $request->get('username');
        $passwod= bcrypt($request->get('passwod'));
        dd( $request);
        $customer= Customer::where('username',  $username) -> where('passwod',$passwod)->first();

        if(!is_null($customer))
        {
            echo "ok";
            die();
        }
         return redirect($this->redirectTo);
    }
}
