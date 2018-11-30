<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Repositories\ProductsRepository;
use Repositories\ProductImagesRepository;
use Repositories\ProductDetailRepository;
use App\TypeProducts;
use App\Wishlist;
use App\Color;
use App\Size;
use App\Manufacture;
use App\Feedback;
use App\Products;
use App\ProductImages;
use App\CategoryProduct;
use App\Returns;
use App\ReturnsDetail;
use App\Slide;
use Cart;
use Session;

class HomepageController extends Controller
{
    //
     public function __construct(ProductsRepository $ProductsRepo,ProductImagesRepository $ProductImagesRepo,ProductDetailRepository $ProductDetailRepo)
     {
           $this->ProductsRepo = $ProductsRepo;
           $this->ProductImagesRepo = $ProductImagesRepo;
           $this->ProductDetailRepo = $ProductDetailRepo; 
     }

     public function index(Request $request) {
       $product=$this->ProductsRepo->all();
        
       $new_products= $product->where('new','=','1');
       $hot_products= $product->where('hot','=','1');
       $discount_product=Products::where('promotion_price','<>',0)->paginate(3);;
       $product_star=Feedback::select( 'id_product', DB::raw( 'AVG(star) as ratings_average' ) )
                        ->groupBy('id_product')->orderBy('ratings_average' ,'DESC')->paginate(3); 
       $type_product=TypeProducts::all(); 
       $slide=Slide::orderBy('id')->get();

        return view('frontend/pages/index', compact('new_products','type_product','hot_products','product_star','discount_product','slide'));
    }
     public function cartPage(Request $request) {

        return view('frontend/pages/cart');
    }

    public function view_product($id_product)
    {
        $type_product=TypeProducts::all();
        $product= $this->ProductsRepo->all()->where('id_product',$id_product)->first();
        $group_product=$this->ProductsRepo->all()->where('id_type',$product->id_type);
        $prd_color= $this->ProductImagesRepo->all()->where('id_product',$id_product)->first();
        $list_prd_cl= ProductImages::where('id_product',$id_product)->get();
        $type_product=TypeProducts::all();
       $img= explode(',', $prd_color->image);
       $list_img =array();
       $list_color=array();
       foreach ($list_prd_cl as $key => $value) {
        $get_img=explode(",", $value->image);
        //dd($get_img);
        $list_img[] =$get_img[0];
        $list_color[]=$value->id_color;
       }

      $size=$this->ProductDetailRepo->getSize( $prd_color->id_color,$id_product);
      $comment=Feedback::where('id_product',$id_product)->get();
      $star=0;
      if (!empty($comment)) {
           foreach ($comment as $key => $value) {
        $star+=$value->star;
      }
      if(count($comment)>0){
        $star =$star/count($comment);
      }
      
      }
     
      return view('frontend/pages/productDetail',compact('product','list_prd_cl','img','size','type_product','list_img','list_color','comment','star','group_product'));
     
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
    public function categoryProduct()
    {  $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
         return view('frontend/pages/product', compact('type_product','colors','sizes','manufacturer'));
    }
    public function categoryProduct_type($id,$gender)
    {
        $products=Products::where('id_type',$id)
                            ->where('gender',$gender)
                            ->paginate(6);              
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));

    }
    public function addToWishList(Request $request)
    {
         if(!Session::has('user_id'))
        {
             return "NotLogin";
        }
        $input['id_user']= Session::get('user_id');
        $input['id_product']= $request->get('id_product');
        $input['id_color']=$request->get('id_color');
        $input['id_size']=$request->get('id_size');
        $input['image']=$request->get('img');

        Wishlist::create($input);
        return "OK";

    }
    public function deleteInWishlist(Request $request)
    {
        $a=Wishlist::where('id_user',Session::get('user_id'))
                 ->where('id_product',$request->get('id_product'))
                ->where('id_color',$request->get('id_color'))
                ->where('id_size',$request->get('id_size'));


            $a->delete();
            return  "Deleted";

               
    }

    public function search(Request $request)
    {
        $search=$request->all();
        $type_product=TypeProducts::all();
        $products=$this->ProductsRepo->search($search);
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));

    }
    public function search_group(Request $request)
    {
        $type_product=TypeProducts::all();
        $manufacturers= Manufacture::all();
        $min= $request->get('min_price');
        $max= $request->get('max_price');
        $type= $request->get('arr_type');
        // $color= $request->get('arr_color');
        $manufacturer= $request->get('arr_manufacturer');
        $arr_type='';
        $arr_manufacturer='';
        if(!empty($type))
         {
            $arr_type=explode(',',trim($type,','));
         }
         else {
            foreach ($type_product as $key => $value) {
                 $arr_type .=$value->id .',';
            }
             $arr_type=explode(',',trim($arr_type,','));
         }
          if(!empty($manufacturer))
         {
            $arr_manufacturer=explode(',',trim($manufacturer,','));
         }
         else {
            foreach ($manufacturers as $key => $value) {
                 $arr_manufacturer .=$value->id .',';
            }
             $arr_manufacturer=explode(',',trim($arr_manufacturer,','));
         }
        $products=$this->ProductsRepo->search_price($min,$max,$arr_type, $arr_manufacturer);
        $html='';
        foreach ($products as $value)
        {
             $html .='<div class="box-product col-md-4">
                <div class="single-product" class="uk-width-medium-1-2 uk-flex" data-uk-scrollspy="{cls:"uk-animation-scale-up", delay: 400}">
                    <div class="product-f-image">
                        <img src="'.url($value->image).'" alt=""  >
                        <div class="product-hover">
                        <a href="'.url('/product/'.$value->id_product).'" class="add-to-cart-link"><i class="fa fa-link"></i> Xem chi tiết</a>
                            <a data-toggle="modal" data-target="#detail-prod" id="'.$value->id_product.'" class="view-details-link"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            
                        </div>
                    </div>
                    
                    <h2 class="text-center"><a>'.$value->name.'</a></h2>
                    
                    <div class="product-carousel-price text-center">
                        <ins>'.number_format($value->price,"0",",",".").'</ins>' ;
                        if ($value->promotion_price != 0){
                         $html.='<del>'.number_format($value->promotion_price,0,",",".").'</del>';
                        }
                   $html .='</div> 
                </div>
            </div>';
        }
       
        return $html;
    }
    public function send_rating(Request $request)
    {
        $input['id_user']=Session::get('user_id');
        $input['virtual_name']= $request->get('name');
        $input['id_product']= $request->get('product');
        $input['star']= $request->get('star');
        $input['content']= $request->get('content');
        Feedback::create($input);
        return 'sent';
    }
    public function get_menu_male()
    {
        $category=CategoryProduct::where('gender',1)->get();
        $html='';
        foreach ($category as $key => $value) {
            $html .='<li><a href="'.url($value->url).'">'.$value->type->name.'</a></li>';
        }
        return $html;
    }
    public function get_menu_female()
    {
        $category=CategoryProduct::where('gender',2)->get();
         $html='';
        foreach ($category as $key => $value) {
            $html .='<li><a href="'.url($value->url).'">'.$value->type->name.'</a></li>';
        }
        return $html;
    }
    public function new_products()
    {
        $products= Products::where('new',1)->paginate(6);
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));
         
    }
    public function product_is_highly_appreciated()
    {
        $getId=Feedback::select( 'id_product', DB::raw( 'AVG(star) as ratings_average' ) )
                        ->groupBy('id_product')->orderBy('ratings_average' ,'DESC')->get();
        $arrayID = array();
        foreach ($getId as $key => $value) {
            $arrayID[]= $value->id_product;
        }
        $products= Products::whereIn('id_product',$arrayID)->paginate(6);              
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));

    }
   public function returns(Request $request)
    {
      $arr=explode(',',trim($request->get('arr'),','));
      $input['reason']=$request->get('reason');
      $input['status_returns']=1;
      $input['id_user']= Session::get('user_id');
      $input['date_returns']=date('Y-m-d');
     $id= Returns::create($input);
      foreach ($arr as $value) {
        $input_detail['id_product']=$value;
        $input_detail['id_returns']=$id->id;
        ReturnsDetail::create($input_detail);
      }

      return 'sent';
    }

    public function slide_1()
    {
       $products= Products::where('new',1)->where('id_type',9)->paginate(6);
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));
    }
    public function slide_2()
    {
        $products= Products::where('price','>=','99000')->paginate(6);
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));
    }
    public function slide_3()
    {
        $products= Products::where('new',1)->paginate(6);
        $type_product=TypeProducts::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturer= Manufacture::all();
        return view('frontend.pages.listProduct',compact('products','type_product','manufacturer','sizes','colors'));
    }
    public function get_silde()
    {
        $category=Silde::groupBy('id');
         $html='';
        foreach ($category as $key => $value) {
            $html .='<li><a href="'.url($value->url).'">'.$value->type->name.'</a></li>';
        }
        return $html;
    }
   
}
