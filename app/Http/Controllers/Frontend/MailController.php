<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\PromocodesModel;
use App\Register;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function register(Request $request)
	{
		$code= PromocodesModel::where('cash',50000)
                                ->where('is_used',0)
                                ->whereDate('expiration_date','>=',date('Y-m-d'))
                                ->first();
	  $email=  $request->get('email');
	   $check = Register::where('email',$email)->first();
	   if (!empty($check)) {
	   		return 'had';
	   }
	   if(empty($code))
	   {
	   	 // Mail::send($code->code, function($message) use ($email) {
      //       $message->to($email, 'Visitor')->subject('Đăng ký thành công!');
      //   });
	   	// Mail::to($email)->send(new Email('Hiện đang hết code!!'));
	   	return 'sent';
	   }
	   else {
	   		Mail::send('email.register',['code'=>$code->code], function($message) use ($email) {
	   			$message->from('cuong56800@st.vimaru.edu.vn', 'HVC Shop');
      			$message->to($email)->subject('Đăng ký thành công!');
      		});
	   	return 'sent';
	   }
	   
	   
	   
	}
}
