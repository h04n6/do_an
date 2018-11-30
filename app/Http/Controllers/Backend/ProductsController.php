<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ProductsRepository;
use Repositories\TypeProductRepository;
use Repositories\StoreRepository;
use Repositories\ProductStoreRepository;
use Repositories\ManufacturerRepository;
use Repositories\ColorRepository;
use Repositories\SizeRepository;
use Repositories\ProductImagesRepository;
use Repositories\ProductDetailRepository;
use App\Color;
use App\ProductDetail;
use App\ProductStore;
use App\Gender;
class ProductsController extends Controller
{
    public function __construct(ProductsRepository $ProductsRepo, TypeProductRepository $TypeProductRepo,StoreRepository $StoreRepo, ProductStoreRepository $ProductStoreRepo ,ManufacturerRepository $ManufacturerRepo,ColorRepository $ColorRepo, SizeRepository $SizeRepo,ProductImagesRepository $ProductImagesRepo,ProductDetailRepository $ProductDetailRepo  )
	{
	   $this->ProductsRepo = $ProductsRepo;
       $this->TypeProductRepo = $TypeProductRepo;
       $this->StoreRepo = $StoreRepo;
       $this->ProductStoreRepo = $ProductStoreRepo;

       $this->ManufacturerRepo = $ManufacturerRepo;
       $this->ColorRepo = $ColorRepo;
       $this->SizeRepo = $SizeRepo;
       $this->ProductImagesRepo = $ProductImagesRepo;
       $this->ProductDetailRepo = $ProductDetailRepo;
	}
    

      public function indexInStore(Request $request) {

        $products = $this->ProductsRepo->getAllProductsInStore($request);
        $type= $this->TypeProductRepo->getAllProducts();
        $store= $this->StoreRepo->all();
        $pro_store = $this->ProductStoreRepo->all();
        $sizes=$this->SizeRepo->all();

        $colors=$this->ColorRepo->all();
        $id_store=1;
        if(!empty($request->get('id_store')))
        {
             $id= $request->get('id_store');
              $id_store= $this->StoreRepo->find( $id);
               $id_store=  $id_store->id;
        }


        return view('backend/Products/store/index', compact('products','type','store','id_store','pro_store','sizes','colors'));
    }
    public function index_product()
    {
    	$products = $this->ProductsRepo->getAll();
    	 return view('backend/Products/index', compact('products'));
    }


    public function create() {
        $type= $this->TypeProductRepo->getAllProducts();
        $stores= $this->StoreRepo->all();
        $id_product = $this->ProductsRepo->getID();
        $manuf=$this->ManufacturerRepo->all();
        $colors=$this->ColorRepo->all();
        $sizes=$this->SizeRepo->all();
      $gender= Gender::orderBy('id')->get();
        return view('backend/Products/create',compact('type','sizes','colors','id_product','manuf','stores','gender'));
    }
  	public function createInStore()
  	{
  		$products = $this->ProductsRepo->getAll();

  		$sizes=$this->SizeRepo->all();
  		$colors=$this->ColorRepo->all();
  		$stores= $this->StoreRepo->all();
  		return view('backend/Products/store/create',compact('products','stores'));
  	}
     public function storeInStore(Request $request) {
        $input = $request->all();
        // dd($input );
        //  if (!$this->ProductStoreRepo->validateCreateUni($input['id_store'], $input['id_product'])) {
        //     return redirect()->back()->with('mss_error', 'Sản phẩm đã tồn tại trong kho!')->withInput();
        // }
         
        $validator = \Validator::make($input, $this->ProductStoreRepo->validateCreateInStore());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
         $colors=$this->ProductImagesRepo->all()->where('id_product',$input['id_product']);
         $check=  ProductStore::where('id_product',$input['id_product'])->where('id_store', $input['id_store'])->first();
         if (!empty( $check)) {
           $i = 0;
             $store['number']=0;
             $store['id_store']=$input['id_store'];
             $store['id_product']= $input['id_product'];
             foreach ($colors as $color) {

            // luu vao product detail
               $inputPrdDetail['id_product']= $input['id_product'];
               $inputPrdDetail['id_store']= $input['id_store'];
               $inputPrdDetail['id_color']=$color->id_color;

               $sizes = $this->SizeRepo->all();
               $j=0;
                foreach ($sizes as $size) {
                  $inputPrdDetail['id_size']=$size->id;
                  $quantity=$input['quantity'];
                  $store['number']+=$quantity[$i][$j];
                  $inputPrdDetail['quantity']=$quantity[$i][$j];
                   ProductDetail::where('id_product',$input['id_product'])
                                  ->where('id_color',$color->id_color)
                                  ->where('id_store',$input['id_store'])
                                  ->where('id_size',$size->id)
                                  ->update(['quantity'=>$quantity[$i][$j]]);
                   $j++;
            }

             $i++;
          }
          // luu vao store
          ProductStore::where('id_product',$input['id_product'])
                        ->where('id_store',$input['id_store'])
                        ->update(['number'=>$store['number']]);
         }
         else{
              $i = 0;
             $store['number']=0;
             $store['id_store']=$input['id_store'];
             $store['id_product']= $input['id_product'];
             foreach ($colors as $color) {

            // luu vao product detail
               $inputPrdDetail['id_product']= $input['id_product'];
               $inputPrdDetail['id_store']= $input['id_store'];
               $inputPrdDetail['id_color']=$color->id_color;

               $sizes = $this->SizeRepo->all();
               $j=0;
                foreach ($sizes as $size) {
                  $inputPrdDetail['id_size']=$size->id;
                  $quantity=$input['quantity'];
                  $store['number']+=$quantity[$i][$j];
                  $inputPrdDetail['quantity']=$quantity[$i][$j];
                   $this->ProductDetailRepo->create($inputPrdDetail);
                   $j++;
            }

             $i++;
          }
          // luu vao store
          $this->ProductStoreRepo->create($store);
         }
        //Luu vào product_img
       
        return redirect()->route('admin.productsInStore.index');
    }
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->ProductsRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Luu vào product_img
         $i = 1;
         foreach ($input['id_color'] as $color) {
          $inputPrdImg['id_product']=$input['id_product'];
          $inputPrdImg['id_color']=$color;
          $listImg="";
          if(isset($input['image_list']))
          {
              $file=$input['image_list'];
              foreach ($file[$i] as $value) {
                $value->move('uploads',$value->getClientOriginalName());
                 $listImg .= 'uploads/'. $value->getClientOriginalName() .',';
              }
              $inputPrdImg['image'] = rtrim($listImg,',');
               foreach ($file[1] as $value) {
                $get_main_img= 'uploads/'. $value->getClientOriginalName() .',';
               }
               $get_main_img=explode(',',rtrim($listImg,','));
              $inputPrd['image']=$get_main_img[0];
              
          }
          $this->ProductImagesRepo->create($inputPrdImg);
          $i++;
      }
          

      // luu vao product
        if(!isset($input['hot']))
        {
            $inputPrd['hot']=0;
        }
        else  $inputPrd['hot']=1;
         if(!isset($input['new']))
        {
            $inputPrd['new']=0;
        }
        else  $inputPrd['new']=1;
         if(!isset($input['promotion_price']))
        {
            $inputPrd['promotion_price']=0;
        }
        else { $inputPrd['promotion_price']=$input['promotion_price']; }
        
        // if (isset($input['image'])) {
        //     $file=$input['image'];
        //     $file->move('uploads',$file->getClientOriginalName());
        //     $inputPrd['image'] = 'uploads/'. $file->getClientOriginalName();
        // }
        $inputPrd['id_product']=$input['id_product'];
        $inputPrd['name']=$input['name'];
        $inputPrd['id_type']=$input['id_type'];
        $inputPrd['gender']=$input['gender'];
        $inputPrd['description']=$input['description'];
        $inputPrd['import_price']=$input['import_price'];
        $inputPrd['price']=$input['price'];
        $inputPrd['id_manufacturer']=$input['id_manufacturer'];
        $this->ProductsRepo->create($inputPrd);
        return redirect()->route('admin.products.index');
    }

     public function edit($id_product) {
        $products = $this->ProductsRepo->all()->where('id_product',$id_product)->first();
        $color=$this->ProductImagesRepo->all()->where('id_product',$id_product);
        $arr='';
        $i=0;
        $j=0;
        $colorAll= $this->ColorRepo->all();
        $images = array();

        foreach ($color as $value) {
           	$images[] =explode(",",$value->image);
           	// $arr=explode("/",$images[$value->id][0]);
           	//  dd($arr);
           } 
		//$images = glob('uploads/*.*');
		//dd($images);
        $type= $this->TypeProductRepo->getAllProducts();
        $manuf=$this->ManufacturerRepo->all();

        return view('backend/Products/update',compact('type','products','color','colorAll','manuf','images','i','arr','j'));
    }
    public function update(Request $request, $id)
    {
             $input = $request->all();
           $prd['name']= $input['name'];
           $prd['id_product']= $input['id_product'];
           $prd['id_type']= $input['id_type'];
           $prd['gender']= $input['gender'];
           $prd['description']= $input['description'];
           $prd['price']= $input['price'];
           
           $prd['id_manufacturer']= $input['id_manufacturer'];
          
        $validator = \Validator::make($input, $this->ProductsRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if(!isset($input['hot']))
        {

            $prd['hot']=0;
        }
        else  $prd['hot']=1;
         if(!isset($prd['new']))
        {
            $prd['new']=0;
        }
        else  $prd['new']=1;
         if(!isset($prd['promotion_price']))
        {
            $prd['promotion_price']=0;
        }
        else { $prd['promotion_price']= $input['promotion_price'];}
        if(isset($input['image']))
        {
        $prd['image']= $input['image'];
        $file=$prd['image'];
        $file->move('uploads',$file->getClientOriginalName());
        $prd['image']= 'uploads/'. $file->getClientOriginalName();
        }
        else {$prd['image']= $input['image_old'];}

        $arrProductStore['id_product']=$input['id_product'];
        $arrProductColor['id_product']=$input['id_product'];
        $arrProductSize['id_product']=$input['id_product'];
        $arrNumberSize=$input['numberSize'];
        $arrNumberColor=$input['numberColor'];
        
        $Store=$this->StoreRepo->all();

       

            //// cập nhật vào bảng product_color
             $ii=0;
             $arrProductColor['id_store']= $input['id_store'];
             $arrProductStore['number']=0;
            foreach ($input['id_color'] as $id_co) {
            $arrProductColor['id_color']=$id_co;
             if(is_null($arrNumberColor[$ii]))
                {
                    $arrNumberColor[$ii]=0;
                }
            $arrProductColor['number']=$arrNumberColor[$ii];
            $findID =$this->ProductColorRepo->findID( $arrProductColor['id_product'],$arrProductColor['id_store'], $arrProductColor['id_color']);
            if(is_null($findID))
            {
                 $this->ProductColorRepo->create($arrProductColor);
            }
            else{
                 $this->ProductColorRepo->update($arrProductColor, $findID->id);
            }              
            $arrProductStore['number'] +=$arrNumberColor[$ii];
            $ii++;
  
            }
            //// cập nhật vào bảng product_size
            $jj=0;
            $arrProductSize['id_store']=$input['id_store'];
            foreach ($input['id_size'] as $value) {
                $arrProductSize['id_size']=$value;
                if(is_null($arrNumberSize[$jj]))
                {
                    $arrNumberSize[$jj]=0;
                }
                $arrProductSize['number']= $arrNumberSize[$jj];
                $findID =$this->ProductSizeRepo->findID( $arrProductSize['id_product'],$arrProductSize['id_store'], $arrProductSize['id_size']);
                if (is_null($findID)) {
                    $this->ProductSizeRepo->create($arrProductSize);
                }
                else{
                    $this->ProductSizeRepo->update($arrProductSize,$findID->id);
                }
                
                $jj++;
            }
            //// cập nhật vào bảng product_store
             $arrProductStore['id_store']= $input['id_store'];
             $findID =$this->ProductStoreRepo->whereById( $arrProductStore['id_product'],$arrProductStore['id_store']);
            $this->ProductStoreRepo->update($arrProductStore,$findID->id);
            //Cập nhật sản phẩm
        $finnIDprd=$this->ProductsRepo->all();       
        $finnIDprd=$finnIDprd->where('id_product','=',$input['id_product'])->first();
        
        $this->ProductsRepo->update($prd, $finnIDprd->id);
        return redirect()->route('admin.products.edit',['id_product'=> $input['id_product'], 'id_store'=>$input['id_store']])->with('success', 'Update thành công');
    }
    public function destroy_prd($id_prd) {
    	$id_product=$this->ProductsRepo->all()->where('id_product',$id_prd)->first();
    	// 
      
      $this->ProductsRepo->delete($id_product->id);

        return redirect()->back();
    }
    public function destroyInStore($id_prd,$id_store)
    {
      ProductStore::where('id_product',$id_prd)->where('id_store',$id_store)->delete();
    }

    public function changeStatus($id, $name) {
        $this->ProductsRepo->changeStatus($id, $name);
        return redirect()->route('admin.products.index');
    }

     public function toggleGroup(Request $request) {

        $group = $request->get('group');
    
        if (is_null($group)) {
            return redirect()->back();
        }

        $status = $request->get('status');
        if($status==0){
            $this->ProductsRepo->deleteGroup($group);
           
            return redirect()->back();
        }
    }

    public function getNumber(Request $request) {
        $number = $this->ProductStoreRepo->whereById($request->get('id'),$request->get('id_store'));

        $html=$number->number;

        return $html;
    }

     public function getSizeAndColor(Request $request) {
        $Sizes = $this->ProductSizeRepo->whereById($request->get('id'),$request->get('id_store'));

        $html = '<div class="cont" style="height: 150px;">';
        $i=$request->get('i');
        foreach ($Sizes as $key => $size) {
            $html .= '<div class="form-group col-md-2">
                    <label class="">Size '. $size->size->size_name .'</label>
                    <input name="numberSize['.$i.'][]" id="numberSize" type="number" class="form-control" max="'.$size->number.'" placeholder="Max : '.$size->number.'" >

                    </div>';
                    
        }

        $html .= '<div class="col-md-12"></div>';

        $Colors = $this->ProductColorRepo->whereById($request->get('id'),$request->get('id_store'));

          foreach ($Colors as $key => $Color) {
            $html .= '<div class="form-group col-md-2">
                    <label class="">Màu '. $Color->color->color_name .'</label>
                    <input name="numberColor['.$i.'][]" id="numberColor" type="number" class="form-control" max="'.$Color->number.'" placeholder="Max : '.$Color->number.'" >

                    </div>';
        }
        $html .= '</div> </div>';
        // $html .= '<div class="col-md-12">
        //            <div class="form-group col-md-3">
        //             <label class="">Tổng số lượng Size </label>
        //             <input name="totalsize" id="totalsize" type="number" readonly="readonly" class="form-control">
        //            </div>
        //            <div class="form-group col-md-3">
        //             <label class="">Tổng số lượng Màu </label>
        //             <input name="totalcolor" id="totalcolor" type="number" readonly="readonly" class="form-control">
        //            </div></div>';
        return $html;
    }


    public function WarehouseTransfer(Request $request)
    {
    
      $id_store1= $request->get('id_store1');
      $id_store2=  $request->get('id_store2');
      $i=1;
      $colors=$request->get('numberColor');
      $sizes=$request->get('numberSize');
      
     

      foreach ( $request->get('id') as $product) {
          $s1=0; $s2=0; $c1=0; $c2=0;
            $id_product1= $this->ProductStoreRepo->whereById($product ,  $id_store1 );
            $id_product2= $this->ProductStoreRepo->whereById($product ,  $id_store2 );
            
                $totalsize=0;
                foreach ($sizes[$i] as $sz) {
                    $totalsize+=$sz;
                }


                $update_size1 = $this->ProductSizeRepo->whereById($product, $id_store1);
                $update_size2 = $this->ProductSizeRepo->whereById($product, $id_store2);
                    
                    foreach ($update_size1 as $key => $value) {
                         $n1['number']=$value->number-$sizes[$i][$s1];
                         
                        $this->ProductSizeRepo->update($n1,$value->id );
                         if ($s1<count($sizes)) {
                            $s1++;
                         }
                        
                    }
                    foreach ($update_size2 as $key => $value) {
                         $n2['number']=$value->number+$sizes[$i][$s2];
                        
                       $this->ProductSizeRepo->update($n2,$value->id );
                      if ($s2<count($sizes)) {
                            $s2++;
                         }
                    }
                 $update_color1 = $this->ProductColorRepo->whereById($product, $id_store1);
                 $update_color2 = $this->ProductColorRepo->whereById($product, $id_store2);
                

                    foreach ($update_color1 as $key => $value) {
                         $n3['number']=$value->number-$colors[$i][$c1];
                         $this->ProductColorRepo->update($n3,$value->id );
                        if ($c1<count($colors)) {
                            $c1++;
                         }
                    }
                    foreach ($update_color2 as $key => $value) {
                         $n4['number']=$value->number+$colors[$i][$c2];
                        $this->ProductColorRepo->update($n4,$value->id );
                         if ($c2<count($colors)) {
                            $c2++;
                         }
                    }
                
                  

            $input1['number'] =   $id_product1->number - $totalsize;
            $input2['number'] =   $id_product2->number + $totalsize;

           
           $this->ProductStoreRepo->update($input1, $id_product1->id);
           $this->ProductStoreRepo->update($input2, $id_product2->id);
             $i++;
      }

       return redirect()->back();
     
    }


     public function add(Request $request) {
        $products = $this->ProductsRepo->getAllProducts($request);

        $html = '<div class="content-add" style="height: 300px;">  <div class="row">';
        $html .=   ' <div class="form-group col-md-9 ">';
        $html .=   ' <label class="">Chọn sản phẩm</label>';
        $html .=   '<select name="id[]" class="form-control select product" >';
                foreach($products as $key=>$value){
                  $html .=' <option value=" '. $value->id_product . '" > '. $value->id_product . '  - '.$value->name . ' </option>';
                }
                
        $html .= ' </select>';


         $html .=   '</div> </div>';
         $html .= '<div class="form-group list-size-color"></div>';
        // $html .=   ' <div class="form-group col-md-4">';
        // $html .=   ' <label class="">Số lượng</label>';
        // $html .=  '<input name="number[]" id="number" type="number" class="form-control " required="required" >';

        // $html .=    ' </div>';
         $html .=    ' </div>';

        return $html;
    }



     public function addSizeOrColor(Request $request) {
        $ProductSize = $this->ProductSizeRepo->whereById($request->get('id_product'),$request->get('id_store'));
        $ProductColor = $this->ProductColorRepo->whereById($request->get('id_product'),$request->get('id_store'));
          $colors=$this->ColorRepo->all();
         $sizes=$this->SizeRepo->all();

                        if($request->get('i')==1)
                        {
                         $html =' <div class="form-group col-md-7">
                                <select name="id_size[]" class="form-control select">';
                                  
                                    foreach($sizes as $size)
                                    {   
                                        $html .='<option value="'.$size->id.'"';
                                        foreach ($ProductSize as $prdSize)
                                        {
                                         if ($prdSize->id_size==$size->id)
                                         {
                                             $html .=  'disabled="disabled"';
                                        
                                         }  
                                        }
                                     $html .=  '>'.$size->size_name.'</option>';
                                    }

                             $html .='</select>

                                </div>
                                 <div class="col-md-3">
                                     <input name="numberSize[]" type="text" class="form-control " value="">
                                   
                                 </div>
                                  <div class="col-md-2">
                                   <button type="button" class="btn btn-link text-danger" style="padding-left: 0;"><i class=" icon-dash position-left"></i></button>
                                 </div>';
                        }
                        elseif ($request->get('i')==2) {
                             $html =' <div class="form-group col-md-7">
                                <select name="id_color[]" class="form-control select">';
                                  
                                    foreach($colors as $color)
                                    {   
                                        $html .='<option value="'.$color->id.'"';
                                        foreach ($ProductColor as $prdColor)
                                        {
                                         if ($prdColor->id_color==$color->id)
                                         {
                                             $html .=  'disabled="disabled"';
                                        
                                         }  
                                        }
                                     $html .=  '>'.$color->color_name.'</option>';
                                    }

                             $html .='</select>

                                </div>
                                 <div class="col-md-3">
                                     <input name="numberColor[]" type="text" class="form-control " value="">
                                   
                                 </div>
                                  <div class="col-md-2">
                                   <button type="button" class="btn btn-link text-danger" style="padding-left: 0;"><i class=" icon-dash position-left"></i></button>
                                 </div>';
                        }

        return $html;
    }
    public function create_color(Request $request)
    {
        $input= $request->all();

        Color::create($input);
         return redirect()->back();
    }
    public function addColor()
    {

      $sizes=$this->SizeRepo->all();
      $colors=$this->ColorRepo->all();
      $html='  <div class="row">
                <div class="singer-color-size">
      
               <div class="form-group col-md-4">
                  <label for="id_color" class="required">Màu sắc</label>
                  <select name="id_color[]" id="id_color" class=" color1 select">';
                      foreach($colors as $color)
                      {
                         $html .= '<option value=" '. $color->id .'"> '.$color->color_name .' </option>';
                      }
              $html .='</select>
                      </div> </div> </div>';
                return $html;
    }

    public function changeProduct(Request $request)
    {
       $id_product=$request->get('id_product');
       $colors=$this->ProductImagesRepo->all()->where('id_product',$id_product);
       $sizes=$this->SizeRepo->all();
       
       	$html ='<div class="content">';
       	$i=0;
          foreach($colors as $color)
          {
	      	$html .='<div class="row group-add-qty"><div class="form-group col-md-4">
	     	<label for="id_color" class="">Màu sắc</label>';
	        $html .='<input type="text" readonly="readonly" class="form-control" name="id_size" value="'.$color->color->color_name.'">
	        </div>
	        <div class="form-group col-md-3">
           <label class="required">Kích cỡ</label>';
	           foreach($sizes as $size){
	            $html .='<input name="id_size['.$i.'][]" readonly="readonly" class="form-control" value="'.$size->size_name.'">';
	            }
		         $html .= '</div>
		         <div class="form-group col-md-2">
	           <label class="required">Số lượng</label>';
             $d=1;
	           foreach($sizes as $size){
              $size_detail=ProductDetail::where('id_product',$id_product)
                            ->where('id_size',$size->id)
                            ->where('id_color',$color->id_color)
                            ->where('id_store',$request->get('id_store'))->first();
              if(!empty($size_detail))
              {
                $qantity=$size_detail->quantity;
              }
              else{ $qantity=0;}
	            $html .='<input name="quantity['.$i.'][]" type="number" min="0" class="form-control " data-main="'.$d.'"" value="'.$qantity.'">';
              $d++;
	            }
	         $html .= '</div><div class="col-md-2" style="top: 8px;""><label></label>';
            $d=1;
           foreach($sizes as $size){
              $size_detail=ProductDetail::where('id_product',$id_product)
                            ->where('id_size',$size->id)
                            ->where('id_color',$color->id_color)
                            ->where('id_store',$request->get('id_store'))->first();
              if(!empty($size_detail))
              {
                $html .= '<input  type="number" class="add_number form-control" data="'.$d.'" placeholder="+">';
              }
              $d++;
            }
            
                

          $html .= '</div></div>';
	         $i++;
           }
           $html .= '</div>';
        return $html;
    }

    public function changeColorGetImg(Request $request)
    {
       $i=$request->get('i');
           $html ='	<div class="group-img col-md-7">
                            <div class="form-group ">
                            <label for="file" id="file"  >Ảnh sản phẩm</label >
                            <input class="input-list" name="image_list['.$i.'][]" type="file" multiple>
                    </div></div>
                ';
        return $html;
    }

}
