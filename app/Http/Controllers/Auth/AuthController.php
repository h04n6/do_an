<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Repositories\UserRepository;
use Repositories\CityRepository;
use Repositories\CountyRepository;
use Repositories\WardRepository;
use App\TypeProducts;
use Socialite;
use Session;
class AuthController extends Controller {

    public function __construct(UserRepository $userRepo,CityRepository $CityRepo,CountyRepository $CountyRepo, WardRepository $WardRepo) {
        $this->userRepo = $userRepo;
          $this->CityRepo = $CityRepo;
           $this->CountyRepo = $CountyRepo;
           $this->WardRepo = $WardRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return view('backend.auth.login');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function postLogin(\Illuminate\Http\Request $request) {
        
        $input = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
        if (Auth::attempt($input, true)) {
            $user = Auth::user();
            $user->save();
            if (in_array($user->role_id, User::ROLE_ADMIN)&& $user->status==1) {
                 Session::put('role_id', $user->role_id);
                return Redirect::route('admin.index');
            } elseif($user->role_id==User::ROLE_CUSTOMER) {
                  Session::put('name', $user->name);
                  Session::put('user_id', $user->id);
              return Redirect::route('home');
            }
            else {
                  return Redirect::route('login')->with('error', 'Bạn không có quyền truy cập trang web.');
            }
        }
        return Redirect::route('login')->with('error', 'Wrong login account');
    } 

    /**
     * 
     * @return type
     */
    public function logout() {
        Auth::logout();
        Session::forget('name');
        Session::forget('user_id');
        return Redirect::route('login');
    }

    public function getCustomerRegister()
    {
      $type_product=TypeProducts::all();
      $citys= $this->CityRepo->getAll();

        return view("frontend/pages/register",compact('type_product','citys'));
    }
    public function postCustomerRegister(Request $request)
    {
       $input=$request->all();
       
       $validator = \Validator::make($input, $this->userRepo->validateCustomer());
       if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); 
        }
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $city= $this->CityRepo->find( $input['id_city']);

        $county = $this->CountyRepo->find($input['id_county']);
        $ward = $this->WardRepo->find($input['id_ward']);
        $input['address'] = $city->name .','.$county->name.','.$ward->name;
        $input['role_id']=User::ROLE_CUSTOMER;
        $this->userRepo->create($input);
        return redirect()->route('login')->with('register_success','OK');
    }







     public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user= Socialite::driver('google')->stateless()->user();
        
        $authUser= $this->findOrCreateUser($user);
        $getUser = user::where('provider_id', $user->id)->first();
        Session::put('name', $getUser->name);
         Session::put('user_id', $getUser->id);

       Auth::login($authUser,true);
         return Redirect::route('home');
    }


     public function findOrCreateUser($user)
    {
        $authUser = user::where('provider_id', $user->id)->first();
         
        if ($authUser) {
            return $authUser;
        }
        
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => 'google',
            'provider_id' => $user->id,
            'role_id'=> User::ROLE_CUSTOMER
        ]);
    }
}
