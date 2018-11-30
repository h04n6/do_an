<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\TypeProductRepository;

class TypeProductController extends Controller
{
     public function __construct(TypeProductRepository $TypeProductRepo)
	{
		 
           $this->TypeProductRepo = $TypeProductRepo;
	}
    

      public function index(Request $request) {
       
         $type= $this->TypeProductRepo->getAllProducts();
        return view('backend/TypeProduct/index', compact('type'));
    }


    public function create() {
        $type= $this->TypeProductRepo->getAllProducts();
       
        return view('backend/Products/create',compact('type'));
    }
     public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->TypeProductRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->TypeProductRepo->create($input);

        return redirect()->back();
    }

     public function edit($id_product) {
        $products = $this->ProductsRepo->find($id_product);
        $type= $this->TypeProductRepo->getAllProducts();
       
        return view('backend/TypeProduct/update',compact('type','products'));
    }
    public function update(Request $request, $id)
    {
      $input = $request->all();
        $validator = \Validator::make($input, $this->TypeProductRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       $this->ProductsRepo->update($input, $id);
        return redirect()->route('admin.products.edit', $id)->with('success', 'Update thành công');
    }
    public function destroy($id) {
        $this->ProductsRepo->delete($id);
        return redirect()->back();
    }
}
