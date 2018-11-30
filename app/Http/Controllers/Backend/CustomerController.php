<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Repositories\CustomerRepository;
use Repositories\CityRepository;
use Repositories\CountyRepository;
use Repositories\WardRepository;
use Repositories\BillRepository;
use Repositories\BillDetailRepository;

class CustomerController extends Controller
{
       public function __construct(CustomerRepository $CustomerRepo, CityRepository $CityRepo, CountyRepository  $CountyRepo, WardRepository $WardRepo, BillRepository $BillRepo,BillDetailRepository $BillDetailRepo) {
        $this->CustomerRepo = $CustomerRepo;
        $this->CityRepo = $CityRepo;
        $this->CountyRepo = $CountyRepo;
        $this->WardRepo = $WardRepo;
        $this->BillRepo = $BillRepo;
        $this->BillDetailRepo = $BillDetailRepo;
    }

   public function index(Request $request) {
        $search = $request->all();
        $customers = $this->CustomerRepo->getAllCustomer($request);
        $city= $this->CityRepo->getAll();
       	$county= $this->CountyRepo->getAll();
        $ward= $this->WardRepo->getAll();

        return view('backend/customer/index', compact('customers','city','county','ward','search'));
    }
    public function des()
    {
         return view('backend/customer/des');
    }

     public function create() {

        return view('backend/customer/create');
    }

    public function store(Request $request) {
        $input = $request->all();

        $validator = \Validator::make($input, $this->CustomerRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role_id = $this->CustomerRepo->getRoleID();
        $input['role_id'] = $role_id;
        $this->CustomerRepo->create($input);

        return redirect()->route('admin.customer.index');
    }

    public function edit($id) {
        $customer = $this->CustomerRepo->find($id);
        return view('backend/customer/update', compact('customer'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->CustomerRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->CustomerRepo->update($input, $id);
        return redirect()->route('admin.customer.edit', $id)->with('success', 'Update thành công');
        ;
    }

    public function destroy($id) {
        $this->CustomerRepo->delete($id);
        return redirect()->back();
    }


      public function export(Request $request) {
        $group = $request->get('group');
        if (!is_null($group)) {
            $this->CustomerRepo->exportCustomer($group);
        }
        return redirect()->back();
    }

    public function detail($id)
    {
    	$customer= $this->CustomerRepo->find($id);

    	$bills=$this->BillRepo->all();
    	$bill=$bills->where('id_customer','=',$id)->first();
    	return view('backend/customer/bill/detail', compact('customer','bill'));
    }
     public function bill($id)
    {
    	$customer= $this->CustomerRepo->find($id);
    	$bills=$this->BillRepo->all();
    	$bill=$bills->where('id_customer','=',$id);
    	return view('backend/customer/bill/bill', compact('customer','bill'));
    }

        public function billDetail($id,$id_bill)
    {
    	$customer= $this->CustomerRepo->find($id);
    	$billDetail=$this->BillDetailRepo->all();
    	$bill=$billDetail->where('id_bill','=',$id_bill);
    	
    	return view('backend/customer/bill/billDetail', compact('customer','bill'));
    }

    public function checkLogin (Request $request)
    {

        $username= $request->get('username');
        $password=$request->get('password');
         $customer = $this->CustomerRepo->all()->where('username',  $username)->first();
         if(is_null($customer))
        {

             return $html= "<span class='content-moitice' style='color:red;'> Sai Tài khoản! </span>";
        }
        elseif(decrypt($customer->password)!= $password )
        {
             return $html= "<span class='content-moitice'  style='color:red;'> Sai Mất khẩu!! </span>";
        }
        else{
             return redirect()->route('home')->with('username', $username);
        }

    }
    public function customerLogin(Request $request)
    {
        $username= $request->get('username');
        $password=$request->get('password');
        $customer = $this->CustomerRepo->all()->where('username',  $username)->first();
        if(is_null($customer))
        {

             return redirect()->route('home')->with('error', 'Sai toàn khoản!');
        }
        elseif (decrypt($customer->password)!= $password )
        {
            return redirect()->route('home')->with('error', 'Sai mật khẩu!');
        }
        else {
           
        }


        
    }
}
