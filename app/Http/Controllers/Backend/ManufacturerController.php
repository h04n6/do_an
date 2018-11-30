<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ManufacturerRepository;

class ManufacturerController extends Controller
{
     public function __construct(ManufacturerRepository $ManufacturerRepo)
	{
		 
       $this->ManufacturerRepo = $ManufacturerRepo;

	}
    
    public function index(Request $request) {
       
        $Manufac= $this->ManufacturerRepo->all();
        return view('backend/manufacturer/index', compact('Manufac'));
    }

    public function create() {
        return view('backend/manufacturer/create');
    }
    public function store(Request $request) {

        $input = $request->all();
        $validator = \Validator::make($input, $this->ManufacturerRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->ManufacturerRepo->create($input);

        return redirect()->back();
    }

    public function edit($id) {
        $Stores= $this->ManufacturerRepo->find($id);
       
        return view('backend/manufacturer/update',compact('Stores'));
    }
    public function update(Request $request, $id)
    {
      $input = $request->all();
        $validator = \Validator::make($input, $this->ManufacturerRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       $this->ManufacturerRepo->update($input, $id);
        return redirect()->route('admin.manufacturer.edit', $id)->with('success', 'Update thành công');
    }
    public function destroy($id) {
        $this->ManufacturerRepo->delete($id);
        return redirect()->back();
    }
}
