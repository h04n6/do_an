<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ConfigRepository;

class ConfigController extends Controller {

    public function __construct(ConfigRepository $configRepo) {
        $this->configRepo = $configRepo;
    }

    public function index() {
        $config = $this->configRepo->detail();
        $config = $config[0];
        return view('backend/config/index', compact('config'));
    }

    public function create() {

        return view('backend/config/index');
    }

    public function store(Request $request) {
    }

    public function edit($id) {
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->configRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image = $request->file('image');
        
        if ($image == null){
            $input['image'] = null;
        }else{
            $destinationPath = 'uploads';
            $input['image'] = $destinationPath.'/'.$image->getClientOriginalName();
            $image->move($destinationPath,$image->getClientOriginalName());
        }
        $icon = $request->file('icon');
        if ($icon == null){
            $input['icon'] = null;
        }else{
            $destinationPath = 'uploads';
            $input['icon'] = $destinationPath.'/'.$icon->getClientOriginalName();
            $icon->move($destinationPath,$icon->getClientOriginalName());
        }
        $favicon = $request->file('favicon');
        if ($favicon == null){
            $input['favicon'] = null;
        }else{
            $destinationPath = 'uploads';
            $input['favicon'] = $destinationPath.'/'.$favicon->getClientOriginalName();
            $favicon->move($destinationPath,$favicon->getClientOriginalName());
        }
        $this->configRepo->update($input, $id);
        $config = $this->configRepo->detail();
        return redirect()->back()->with('success', trans('base.mss_success'));     
    }

    public function destroy($id) {
        $this->configRepo->delete($id);
        return redirect()->back();
    }

}
