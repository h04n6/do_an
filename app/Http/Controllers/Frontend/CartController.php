<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Repositories\ProductsRepository;
use Repositories\ProductImagesRepository;
use Repositories\ProductDetailRepository;

use Repositories\UserRepository;
use Repositories\CityRepository;
use Repositories\CountyRepository;
use Repositories\WardRepository;
use Repositories\BillRepository;
use Repositories\BillDetailRepository;

use App\CartSave;
use App\CartDetail;
use App\Size;
use App\Color;
use App\ShipCost;
use Cart;
use Session;
use App\TypeProducts;
use App\PromocodesModel;
use App\ProductStore;
use App\Products;
use App\ProductImages;
use App\Feedback;
class CartController extends Controller
{
	  public function __construct(ProductsRepository $ProductsRepo,UserRepository $userRepo,CityRepository $CityRepo,CountyRepository $CountyRepo, WardRepository $WardRepo,BillDetailRepository $BillDetailRepo, BillRepository $BillRepo,ProductImagesRepository $ProductImagesRepo,ProductDetailRepository $ProductDetailRepo)
     {
           $this->ProductsRepo = $ProductsRepo;
           $this->userRepo = $userRepo;
           $this->CityRepo = $CityRepo;
           $this->CountyRepo = $CountyRepo;
           $this->WardRepo = $WardRepo;
           $this->BillDetailRepo = $BillDetailRepo;
           $this->BillRepo = $BillRepo;
           $this->ProductImagesRepo = $ProductImagesRepo;
           $this->ProductDetailRepo = $ProductDetailRepo;
     }

    public function addToCart($id)
    {
        $product= $this->ProductsRepo->all()->where('id_product',$id)->first();
        $type_product=TypeProducts::all();
        // if (Session::has('user_id')) {
        //     $id_user=Session::get('user_id');
        //     $cart= CartSave::where('id_user',$id_user)->first();
        //     if(is_null($cart))
        //     {
        //         $inputCart['id_user']=$id_user;
        //         $inputCart['total_cart']=$product->price;
        //         CartSave::create($inputCart);
        //         $cart= CartSave::where('id_user',$id_user)->first();
        //         $inputDetailCart['id_cart']= $cart->id;
        //         $inputDetailCart['id_product']=$product->id;
        //         $inputDetailCart['price']=$product->price;
        //         $inputDetailCart['quantity']=1;
        //         $inputDetailCart['total']=$product->price;
        //         CartDetail::create($inputDetailCart);

        //     }
        //     else{
        //         $cartDetail=CartDetail::where('id_cart',$cart->id)->where('id_product',$product->id)->first();
        //         if (is_null($cartDetail)) {
        //             $inputDetailCart['id_cart']= $cart->id;
        //             $inputDetailCart['id_product']=$product->id;
        //             $inputDetailCart['price']=$product->price;
        //             $inputDetailCart['quantity']=1;
        //             $inputDetailCart['total']=$product->price;
        //             CartDetail::create($inputDetailCart);
        //             $inputCart['id_user']=$id_user;
        //             $inputCart['total_cart']=$cart->total_cart +  $inputDetailCart['total'];
        //              CartSave::where('id',$cart->id)->update($inputCart,$cart->id);
        //         }
        //         else{
        //              $inputDetailCart['quantity']= $cartDetail->quantity + 1;
        //              $inputDetailCart['total']=$product->price + $cartDetail->total;
        //              CartDetail::where('id',$cartDetail->id)->update($inputDetailCart);
        //              $inputCart['id_user']=$id_user;
        //              $inputCart['total_cart']=$cart->total_cart + $cartDetail->total;
        //              CartSave::where('id',$cart->id)->update($inputCart,$cart->id);
        //         }
        //     }

        // }
        // else{
             
        // }

        Cart::add(['id'=>$id,'type_product', 'name' =>$product->name, 'qty'=>1,'price'=>$product->price,'options'=>['size'=>'M', 'img'=>$product->image]]);
       
  
    return redirect()->route('cart');

    	
    }
    public function ajaxAddToCart(Request $request)
    {
        $type_product=TypeProducts::all();
        $id_color= $request->get('id_color');
        $id_product= $request->get('id_product');
        $id_size= $request->get('id_size');
        $qty= $request->get('qty');
        $img=  $request->get('img');
        $product= $this->ProductsRepo->all()->where('id_product',$id_product)->first();
        if ($product->promotion_price !=0) {
           $price=$product->promotion_price;
        }
        else{
            $price=$product->price;
        }
        Cart::add(['id'=>$id_product,'type_product', 'name' =>$product->name, 'qty'=>$qty,'price'=>$price,'options'=>['size'=>$id_size,'color'=>$id_color, 'img'=>$img]]);
        Session::flash('addCart', 'OK');
        // Session::forget('addCart');
        
    }

    public function cart(Request $request) {
     $colors = Color::all();
     $sizes = Size::all();
 	 $content= Cart::content();
     $total= Cart::subtotal(0,',','.');
     // dd(Cart::content());
     $type_product=TypeProducts::all();
      return view('frontend/pages/cart',compact('content','total','colors','sizes','type_product'));
    }

    public function delProductInCart($rowId)
    {
    	Cart::remove($rowId);
    	return redirect()->back();
    }
     public function updateCart(Request $request)
    {
    	$rowId=$request->get('id');
    	$qty=$request->get('qty');
     	Cart::update($rowId,$qty);
    }

    public function getCheckout(Request $request)
    {
        if(!Session::has('user_id'))
        {

             return view('backend/auth/login');
        }
        $type_product=TypeProducts::all();
     $colors = Color::all();
     $sizes = Size::all();
     $content= Cart::content();
     $total_price_prd= Cart::subtotal(0,',','');

     $id_user=Session::get('user_id');
     $user= $this->userRepo->find( $id_user);
     //dd($id_user);
     if ($user->address !=NULL) {
     $address= explode(',',$user->address);
     $address= $address[0];
     $address= $this->CityRepo->whereName($address);
     $ship_costs=ShipCost::where('id_city',$address->id)->orderBy('cost')->first();
     $ship_cost=($ship_costs->type_ship_cost->cost);
     
     $total= (double)$total_price_prd + $ship_cost;
     }
     else{
        $ship_cost=0;
        $total= (double)$total_price_prd + $ship_cost;
     }
     
     
     $citys= $this->CityRepo->getAll();
     date_default_timezone_set('Asia/Ho_Chi_Minh');
     $date_order= date("Y-m-d");
     $start_date_ship = date('Y/m/d',strtotime('+'.$ship_costs->insert_day.' day',strtotime($date_order)));
     $end_date_ship = date('Y/m/d',strtotime('+2 day',strtotime($start_date_ship)));
     //dd($end_date_ship);

      return view('frontend/pages/checkout',compact('content','total_price_prd','user','citys','colors','sizes','start_date_ship','end_date_ship','ship_cost','total','type_product','ship_costs'));
    }
    public function postCheckout(Request $request)
    {

        $input= $request->all();
        //dd((double)$input['total_bill']);
        $validator = \Validator::make($input, $this->BillRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $inputBill['id_bill']=$this->BillRepo->getID();
        $inputBill['id_user']=Session::get('user_id');
        $inputBill['total_bill']=$input['total_bill'];
        $inputBill['ship_cost']=$input['ship_cost'];
        $inputBill['recive_address']= $input['address'] . ', ' . $input['address_detail'];
        $inputBill['reciver']= $input['name'];
        $inputBill['phone']= $input['phone'];
        $inputBill['payment_method']= $input['payment'];
        if(isset($input['coupon_value']))
        {
            $inputBill['coupon']= $input['coupon_value'];
            PromocodesModel::find($input['coupon_code'])->update(['is_used'=>1]);

        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $inputBill['date_order']= date("Y-m-d H:i:s");
        $this->BillRepo->create($inputBill);
        $sizes= Size::all();
        $colors= Color::all();
        $inputBillDetail['id_bill']= $inputBill['id_bill']; 
        $content= Cart::content();
        foreach ($content as $value) {
            $inputBillDetail['id_product']= $value->id;
            $inputBillDetail['price']=$value->price;
            $inputBillDetail['quantity']=$value->qty;
            $inputBillDetail['total']=$value->qty * $value->price;
            $inputBillDetail['id_store']=$input['id_store'];

            $size_name='';
            $color_name='';
            foreach ($sizes as $size) {
                if($value->options->size==$size->id)
                {
                    $size_name= $size->size_name;
                }
            }
            foreach ($colors as $color) {
                if($value->options->color==$color->id)
                {
                    $color_name= $color->color_name;
                }
            }
            $inputBillDetail['product_info']= 'Màu: ' . $color_name. ', Size: '.$size_name ;
            Session::forget('subtotal_vitual');
            $this->BillDetailRepo->create($inputBillDetail);

           


        }
        
        Cart::destroy();
        
        return redirect()->route('home')->with('alert',"OK");

    }
    public function getCounty(Request $request)
    {
        $id_city = $request->get('id_city');
        $county = $this->CountyRepo->getAll()->where('id_city',$id_city);
        $html = '';
        foreach ($county as $value) {
            $html = $html . "<option value=" . $value->id . ">" . $value->name . "</option>";
        }
        
        return $html;
    }

     public function getWard(Request $request)
    {
        $id_county = $request->get('id_county');
        $ward = $this->WardRepo->getAll()->where('id_county',$id_county);
        $html = '';
        foreach ($ward as $value) {
            $html = $html . "<option value=" . $value->id . ">" . $value->name . "</option>";
        }
        
        return $html;
    }
    public function view_product(Request $request)
    {
     
        $product= Products::where('id_product',  $request->get('id_product'))->first();
        $prd_color= $this->ProductImagesRepo->all()->where('id_product',$request->get('id_product'))->first();
        $list_prd_cl= ProductImages::where('id_product',$request->get('id_product'))->get();
        $comment=Feedback::where('id_product',$request->get('id_product'))->get();
      $star=0;
      if (!empty($comment)) {
           foreach ($comment as $key => $value) {
        $star+=$value->star;
      }
      if(count($comment)>0){
        $star =$star/count($comment);
      }
      
      }

        $img= explode(',', $prd_color->image);

        $size=$this->ProductDetailRepo->getSize( $prd_color->id_color,$request->get('id_product'));
        $html='
    <div id="" class="modal fade view-product" tabindex="-1" role="dialog" aria-labelledby="productGrid">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           
          </div>
          <div class="modal-body">

            <div class="row">
                  <div class="col-md-6">
                     
                    <div class="main-img col-md-12">
                        <div class="tile" data-scale="1.6" data-image="'.url($product->image).'"></div>
                    </div>
                    <div class="list-add">
                    <div class="list-img col-md-9">';
                    for ($i=0; $i < count($img); $i++) { 
                    $html .= '<div class="img-prd row col-md-4"><img  src="'.url($img[$i]).'"  alt="a"></div> ';
                    }


                   $html .= ' </div> </div>
                  </div>
                  <div class="col-md-6">
        
                        
                <div class="tabbable"> 
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Thông tin sản phẩm</a></li>
                    <li><a href="#tab2" data-toggle="tab">Chi tiết</a></li>
                   
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                       <p class="id_product" id="'.$product->id_product.'">'.$product->name.'</p>
                        <p>';
                        if ($star==0) {
                            for ($i = 0; $i < 5; $i++){
                                $html .='<i class="icon-star-empty3" ></i>' ;
                            }
                        }
                        elseif (round($star,2)< round($star) + 0.25){
                             for ($i = 0; $i < round($star); $i++){
                                $html .='<i class="icon-star-full2" style="color: yellow;"></i>' ;
                            }
                        }
                        elseif(round($star,2) >= (round($star) + 0.25) && round($star,2) < (round($star) + 0.75)){
                            for ($i = 0; $i < round($star); $i++){
                                $html.='<i class="icon-star-full2" style="color: yellow;"></i>';
                            }
                            $html.='<i class=" icon-star-half" style="color: yellow;"></i>';
                        }
                        else{
                            for ($i = 0; $i < round($star)+1; $i++){
                                $html.='<i class="icon-star-full2" style="color: yellow;"></i>';
                            }
                            
                        }
                        
                       $html.='</p>
                       <p>Giá sản phẩm: '.number_format($product->price,0,',','.').' đ</p>
                       <div class="color-prd row">
                          <p>Màu sắc:</p>
                          <div class="group-img">';
                          foreach ($list_prd_cl as $key => $value) {
                             $img_list= explode(',', $value->image);
                              $html .='<div class="col-md-2"> <img id="'.$value->id_color.'" style="width: 60px; height: 50px; margin: 0 5px;" src="'.url($img_list[0]).'" class="img-responsive" alt="2"></div>';
                          }

                         $html.='</div>
                       </div>
                       <form>
                       <div class="size-prd row col-md-12">
                        <p>Kích thước: </p>
                        <div class="group-size"><div class="size-cont">';

                           $arr[]=0;
                           $i=0;
                           if (count($size)==0) {
                            $html.='<div class="out-of-stock"><span>Hết hàng</span></div>';
                           }
                           foreach ($size as $key => $value1) {
                      
                                     if ($value1->quantity !=0 && ($this->check($arr,$value1->id_size))==1 ) 
                                     {
                                        
                                              $html.= '<div class="col-md-1"><a id="'.$value1->id_size.'" class="size text-center">'.$value1->size->size_name.'</a></div>';
                                              $arr[]=$value1->id_size;
                                     }

                           }      
                          
                        $html.='</div></div>
                       </div>
                        <div class="quantity buttons_added">
                          <label>Số lượng </label>
                            <input type="button" class="minus" value="-">
                            <input type="number" size="4" name="qty" class="input-text qty text" title="Qty" value="1" min="0" step="1">
                            <input type="button" class="plus" value="+">
                        </div>

                        <div class=" col-md-12">';
                        if (count($size)==0) {
                            $html .='<div class=" btn-add-cart row col-md-7"><a class="btn border-slate btn-flat disable" data-dismiss="modal"><i class="icon-cart"></i> Thêm vào giỏ hàng</a></div>';
                        }
                        else{
                             $html .='<div class=" btn-add-cart row col-md-7"><a class="btn border-slate btn-flat " data-dismiss="modal"><i class="icon-cart"></i> Thêm vào giỏ hàng</a></div>';
                        }
                        $html .='<div class=" btn-heart row col-md-5"><a  class="wishlist btn border-slate text-slate-800 btn-flat"><i class="icon-heart5"></i> </a></div>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                       <p>Hãng:'.$product->manufacturer->name.'</p>
                      <p>Mô tả:'.html_entity_decode($product->description).' </p>
                    </div>

                  </div>
              </div>
            </div>
              </div>
            
           
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->';
    return $html;
    }

    public function get_list_img(Request $request)
    {
        $list_prd_cl= $this->ProductImagesRepo->all()->where('id_product',$request->get('id_product'))
                                                    ->where('id_color',$request->get('id_color'))->first();
                                                    
         $img_list= explode(',', $list_prd_cl->image);
         $html=' <div class="list-img col-md-9">';
        for ($i=0; $i < count($img_list) ; $i++) { 
             $html .= '<div class="img-prd row col-md-4"><img  src="'.url($img_list[$i]).'"  alt="a"></div> ';
        }
       
        
        $html .= '</div>';
        $a[0]=$html;

        $product_detail= $this->ProductDetailRepo->getSize($request->get('id_color'),$request->get('id_product'));
                                            
       $html_size='<div class="size-cont">';
       $arr[]=0;
       $i=0;
        if (count($product_detail)==0) {
           
            $html_size.='<div class="out-of-stock"><span>Hết hàng</span></div>';
       }

             foreach ($product_detail as $key => $value1) {
  
                 if ($value1->quantity !=0 && ($this->check($arr,$value1->id_size))==1 ) 
                 {
                    
                          $html_size.= '<div class="col-md-1"><a id="'.$value1->id_size.'" class="size text-center">'.$value1->size->size_name.'</a></div>';
                          $arr[]=$value1->id_size;

                 }

                }

       
      
    
       $html_size .='</div>';
       $a[1]=$html_size;
        return $a;
    }
      public function check($arr,$x)
    {

        for($i=0;$i<count($arr); $i++)
        {
            if ($x==$arr[$i] ) {
                return 0;
            }
           
        }
        
       return 1;
    }

    public function post_ship_cost(Request $request)
    {
        $ship_cost=ShipCost::where('id_city',$request->get('id_city'))->orderBy('cost')->first();
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
         $date_order= date("Y-m-d");
         $start_date_ship = date('Y/m/d',strtotime('+'.$ship_cost->insert_day.' day',strtotime($date_order)));
         $end_date_ship = date('Y/m/d',strtotime('+2 day',strtotime($start_date_ship)));
        $ship_cost=($ship_cost->type_ship_cost->cost);
        if ($request->get('subtotal_vitual')!=0) {
            $total_price_prd= $request->get('subtotal_vitual')-$request->get('ship_cost');
        }
        else{
            $total_price_prd= (double)Cart::subtotal(0,',','');
        }
        
        $total= $total_price_prd + $ship_cost;

        $html['ship_cost']=number_format($ship_cost,0,',','.');
        $html['ship_cost_vitual']=$ship_cost;
        $html['total_vitual']=$total;
        $html['total']=number_format($total,0,',','.');
        $html['date_ship']='Nhận hàng vào '.date('d/m',strtotime($start_date_ship )).' - '.date('d/m/Y',strtotime($end_date_ship )).'';
        return $html;
    }

    public function apply_coupon(Request $request)
    {
        $discount_code= $request->get('discount_code');
        $check= PromocodesModel::where('code',$discount_code)
                                ->where('is_used',0)
                                ->whereDate('expiration_date','>=',date('Y-m-d'))
                                ->first();

        if ($request->get('subtotal_vitual')!=0) {
            return 'is_had';
        }            
        if(empty($check))
        {
          return 'error';
        }
        else{
            if ($check->cash!=0) {
            $result['coupon']=number_format($check->cash,0,',','.');
           $result['total_bill']= number_format((double)Cart::subtotal(0,',','') - $check->cash + $request->get('ship_cost'),0,',','.');
           $result['subtotal_vitual']=(double)Cart::subtotal(0,',','') - $check->cash+$request->get('ship_cost');
           $result['coupon_value']=$check->cash;
           $result['html']='<div class="content-counpon">
                <div class="col-md-8 ">Giảm giá</div>
                <div class="col-md-4 text-right"> -<span>'.number_format($check->cash,0,',','.').'</span> đ</div>
                <input type="hidden" name="coupon_value" value="'.$check->cash.'">  
                <input type="hidden" name="coupon_code" value="'.$check->id.'">  
                </div> ';

            }
            elseif ($check->percent!=0) {
           $result['coupon']=$check->percent .'%';
           $result['total_bill']= number_format((double)Cart::subtotal(0,',','')*$check->percent/100 + $request->get('ship_cost'),0,',','.');
            $result['subtotal_vitual']= (double)Cart::subtotal(0,',','')*$check->percent/100 + $request->get('ship_cost');
           $result['coupon_value']=(double)Cart::subtotal(0,',','')-((double)Cart::subtotal(0,',','')*$check->percent/100);
           $result['html']='<div class="content-counpon">
                <div class="col-md-8 ">Giảm giá</div>
                <div class="col-md-4 text-right"> <span>'.$check->percent.'%( </span> -<span>'.number_format($result['coupon_value'],0,',','.').'</span> đ )</div>
                <input type="hidden" name="coupon_value" value="'.$result['coupon_value'].'">
                <input type="hidden" name="coupon_code" value="'.$check->id.'">    
                </div> ';  
            }
            return $result;

        }
    }
    
}
