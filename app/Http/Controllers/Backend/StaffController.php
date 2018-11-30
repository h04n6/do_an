<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Staff_type;

class StaffController extends Controller
{
    public function index(Request $request)
    {
    	$staffs=Staff::all();
    	$type=0;
    	$staff_type=Staff_type::all();
    	if(!empty($request->get('type')))
        {
            $id= $request->get('type');
            $type= Staff_type::find( $id);
            $type=  $type->id;
            $staffs=Staff::where('staff_type', $type)->get();
        }
    	return view('backend/staff/index', compact('staffs','staff_type','type'));
    } 
}
