<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\SupplierRepository;

class SupplierController extends Controller
{
     public function __construct(SupplierRepository $SupplierRepo)
	{
		 
       $this->SupplierRepo = $SupplierRepo;
	}
    
    public function index(Request $request) {
         $Stores= $this->SupplierRepo->all();
        return view('backend/supplier/index',compact('Stores'));
    }

    public function create() {
        return view('backend/supplier/create');
    }
    public function store(Request $request) {

        $input = $request->all();
        //dd($input);
        $validator = \Validator::make($input, $this->SupplierRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->SupplierRepo->create($input);

        return redirect()->route('admin.supplier.index');
    }

    public function edit($id_store) {
        $Stores= $this->SupplierRepo->find($id_store);
       
        return view('backend/supplier/update',compact('Stores'));
    }
    public function update(Request $request, $id)
    {
      $input = $request->all();
        $validator = \Validator::make($input, $this->SupplierRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       $this->SupplierRepo->update($input, $id);
        return redirect()->route('admin.supplier.edit', $id)->with('success', 'Update thành công');
    }
    public function destroy($id) {
        $this->SupplierRepo->delete($id);
        return redirect()->back();
    }
}
