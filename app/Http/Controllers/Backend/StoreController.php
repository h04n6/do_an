<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\StoreRepository;
use Repositories\ProductStoreRepository;
use Repositories\ProductSizeRepository;
use Repositories\ProductColorRepository;
use Repositories\ColorRepository;
use Repositories\SizeRepository;
use Repositories\ProductsRepository;
class StoreController extends Controller
{
     public function __construct(StoreRepository $StoreRepo,ProductStoreRepository $ProductStoreRepo ,ProductSizeRepository $ProductSizeRepo,ProductColorRepository $ProductColorRepo,ProductsRepository $ProductsRepo,ColorRepository $ColorRepo, SizeRepository $SizeRepo)
	{
		 
       $this->StoreRepo = $StoreRepo;
       $this->ProductStoreRepo = $ProductStoreRepo;
       $this->ProductSizeRepo = $ProductSizeRepo;
       $this->ProductColorRepo = $ProductColorRepo;
       $this->ProductsRepo = $ProductsRepo;
       $this->ColorRepo = $ColorRepo;
       $this->SizeRepo = $SizeRepo;
	}
    
    public function index(Request $request) {
       
        $Stores= $this->StoreRepo->all();
        $getID= $this->StoreRepo->GetID();
        return view('backend/store/index', compact('Stores','getID'));
    }
    //create trong index

    // public function create() {
    //     $Stores= $this->StoreRepo->all();
    //    	$getID= $this->StoreRepo->GetID();
    //     return view('backend/store/create',compact('Stores','getID'));
    // }
    public function postCreate(Request $request) {

        $input = $request->all();
        dd($input);
        $validator = \Validator::make($input, $this->StoreRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->StoreRepo->create($input);

        return redirect()->route('admin.store.index');
    }

    public function edit($id_store) {
        $Stores= $this->StoreRepo->find($id_store);
       
        return view('backend/store/update',compact('Stores'));
    }
    public function update(Request $request, $id)
    {
      $input = $request->all();
        $validator = \Validator::make($input, $this->StoreRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       $this->StoreRepo->update($input, $id);
        return redirect()->route('admin.store.edit', $id)->with('success', 'Update thành công');
    }
    public function destroy($id) {
        $this->StoreRepo->delete($id);
        return redirect()->back();
    }
}
