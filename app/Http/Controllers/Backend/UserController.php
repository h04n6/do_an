<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Repositories\UserRepository;

use Repositories\RoleRepository;
use Repositories\BillRepository;
use Repositories\BillDetailRepository;
use Repositories\CityRepository;
use App\TypeProducts;
use App\Wishlist;
use Cart;
use App\ShipCost;
use App\Package_order;
use Session;

class UserController extends Controller {

    public function __construct(UserRepository $userRepo,RoleRepository $roleRepo,BillRepository $BillRepo,BillDetailRepository $BillDetailRepo,CityRepository $CityRepo) {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->BillRepo = $BillRepo;
        $this->BillDetailRepo = $BillDetailRepo;
          $this->CityRepo = $CityRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
        $users = $this->userRepo->getAllUser();
        return view('backend/user/index', compact('users'));
    }

    public function create() {
        $roles = $this->roleRepo->getAllRole();
        return view('backend/user/create', compact('roles'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->userRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $this->userRepo->create($input);

        return redirect()->route('admin.user.index');
    }

    public function edit($id) {
        $user = $this->userRepo->find($id);
        $roles = $this->roleRepo->all();
        return view('backend/user/update', compact('user', 'roles'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->userRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->userRepo->update($input, $id);
        return redirect()->route('admin.user.edit', $id)->with('success', 'Update thành công');
    }
    
    public function destroy($id) {
        $this->userRepo->delete($id);
        return redirect()->back();
    }
        public function toggle($id) {
        $this->userRepo->toggle($id);
        return redirect()->back();
    }


    public function adminIndex() { 
        $admins = $this->userRepo->getAdmin();
        return view('backend/user/admin', compact('admins'));
    }
     public function adminEdit($id) {
        $admin = $this->userRepo->find($id);
        return view('backend/user/admin_update', compact('admin'));
    }

    public function adminUpdate(Request $request, $id) {
        $input = $request->all();
        if ($request->changepassword != null) {
            $validator = \Validator::make($input, $this->userRepo->validateUpdate($id));
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $password = $request->get('password');
            $input['password'] = bcrypt($password);
        } else {
            $validator = \Validator::make($input, $this->userRepo->validateAdminUpdate($id));
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $this->userRepo->update($input, $id);
        return redirect()->back()->with('success', 'Update thành công');
    }

    public function adminCreate() {
        return view('backend/user/admin_create');
    }

    public function adminStore(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->userRepo->validateAdminCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $this->userRepo->create($input);
        return redirect()->route('admin.manage')->with('success', trans('base.add_success'));
    }

    public function adminDel($id) {
        $this->userRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    //////////////////


    public function listUserIsCustomer(Request $request)
    {
        $search = $request->all();
        $customers = $this->userRepo->getAllCustomer($request);
        return view('backend/customer/index', compact('customers','search'));
    }

     public function export(Request $request) {
        $group = $request->get('group');
        if (!is_null($group)) {
            $this->userRepo->exportCustomer($group);
        }
        return redirect()->back();
    }


     public function detail($id)
    {
        $customer= $this->userRepo->find($id);
        $bills=$this->BillRepo->all();
        $bill=$bills->where('id_user','=',$id)->first();
        return view('backend/customer/bill/detail', compact('customer','bill')); 
    }
     public function bill($id)
    {

        $customer= $this->userRepo->find($id);
        $bills=$this->BillRepo->all();
        $bill=$bills->where('id_user','=',$id);
        //sdd($customer);
        return view('backend/customer/bill/bill', compact('customer','bill'));
    }

        public function billDetail($id,$id_bill)
    {
        $customer= $this->userRepo->find($id);
        $billDetail=$this->BillDetailRepo->all();
        $bill=$billDetail->where('id_bill','=',$id_bill);
        
        return view('backend/customer/bill/billDetail', compact('customer','bill'));
    }
    // /

    public function myAccount()
    {
        if (Session::has('user_id')) {
             $type_product=TypeProducts::all();
            $id_user=Session::get('user_id');
        $user= $this->userRepo->find($id_user);
         return view('frontend/pages/myAccount',compact('user','type_product'));
        }
        else{
            return view('backend/auth/login');
        }
       
    }
    public function myProduct()
    {
          if (Session::has('user_id')) {
          $type_product=TypeProducts::all();
          $wishlist =Wishlist::where('id_user',Session::get('user_id'))->get();
          return view('frontend/pages/myProduct',compact('type_product','wishlist'));
            }
             else{
            return view('backend/auth/login');
        }
    }
     public function myOrder()
    {
         if (Session::has('user_id')) {
        $type_product=TypeProducts::all();
        $id_user=Session::get('user_id');
        $myOrders= $this->BillRepo->all()->where('id_user',$id_user);

        return view('frontend/pages/listMyOrder',compact('myOrders','type_product'));
        }
          else{
            return view('backend/auth/login');
        }
    }
    public function myOrderDetail($id)
    {
        if (Session::has('user_id')) {
            $type_product=TypeProducts::all();
            $bill= $this->BillRepo->all()->where('id_bill',$id)->first();
            $billDetail=$this->BillDetailRepo->all()->where('id_bill',$id);

             $address= explode(',',$bill->recive_address);
             $address= $address[0];
             $address= $this->CityRepo->whereName($address);
             $ship_costs=ShipCost::where('id_city',$address->id)->orderBy('cost')->first();
             date_default_timezone_set('Asia/Ho_Chi_Minh');
             $date_order= $bill->date_order;
             $start_date_ship = date('Y/m/d',strtotime('+'.$ship_costs->insert_day.' day',strtotime($date_order)));

             $end_date_ship = date('Y/m/d',strtotime('+2 day',strtotime($start_date_ship)));
        return view('frontend/pages/myOrderDetail',compact('bill','billDetail','type_product','start_date_ship','end_date_ship'));
        }
        else{
            return view('backend/auth/login');
        }

    }



}
