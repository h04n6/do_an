<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PromocodesModel;
use Promocodes; 
class DiscountCodeController extends Controller
{
    
      public function index(Request $request) {
       
         $code=PromocodesModel::all();
        return view('backend/discountcode/index', compact('code'));
    }


    public function create() {
       
        return view('backend/discountcode/create');
    }
     public function store(Request $request) {
        $input = $request->all();
        $validator = $request->validate([
        'qty' => 'required|min:1|max:100',
        'value' => 'required',
        'expiration_date' => 'required'
    		]);

        $qty=$input['qty'];
        $is_used=0;
        if($input['type']==0)
        {
        	$cash=$input['value'];
        	$percent=0;
        }
        elseif ($input['type']==1) {
        	$percent=$input['value'];
        	$cash=0;
        }
        $created_at=date('Y-m-d');
        $expiration_date=date('Y-m-d',strtotime($input['expiration_date']));

        Promocodes::create($qty,$is_used,$cash,$percent,$created_at,$expiration_date);
        return redirect()->route('admin.discountcode.index');
    }

    public function destroy($id) {
        PromocodesModel::find($id)->delete();
        return redirect()->back();
    }
    public function toggleGroup(Request $request) {
        $group = $request->get('group');
        if (is_null($group)) {
            return redirect()->back();
        }
        else{
            $this->deleteGroup($group);
            return redirect()->back();
        }

    }
     function deleteGroup($group) {
        if (in_array(0, $group)) {
            $code = PromocodesModel::whereNotIn('id', $group);
        } else {
            $check = true;
            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }
            if ($check == false) {
                $code = PromocodesModel::whereNotIn('id', $group);
            } else {
                $code =PromocodesModel::whereIn('id', $group);
            }
        }
        $code->delete();
    }

   


   
}
