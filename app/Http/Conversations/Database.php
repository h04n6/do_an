<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use App\Color;
use App\Size;
use App\TypeProducts;
use App\Manufacture;
use App\ProductDetail;
use App\Feedback;
use App\Products;
use App\ProductStore;

class Database extends Conversation
{
    public static function test(){
        return 'Whatever you\'re testing, it\'s okay';
    }

    /** */
    public static function getColor(){
        return Color::all();
    }

    /** */
    public static function getSize(){
        return Size::all();
    }

    /** */
    public static function getProductType(){
        return TypeProducts::all();
    }

    /** */
    public static function getBrand(){
        return Manufacture::all();
    }

    /** */
    public static function getProducts($type, $color, $size, $brand){
            $res_detail = ProductDetail::with('size', 'color');
            $res = Products::with('type')->where('id_type', '=', $type);
            
            // if($type != ''){
            //     $res = $res->where('id_type', '=', $type);
            // }
            // if($color != ''){
            //     $res_detail = $res_detail->where('id_color', '=', $color);
            // }
            // if($size != ''){
            //     $res_detail = $res_detail->where('id_size', '=', $size);
            // }
            // if($brand != ''){
            //     $res = $res->where('id_manufacturer', '=', $brand);
            // }

            $res_quantity = ProductStore::where('id_product', '=', ($res->first())->id_product);

            return [
                'detail' => $res_detail->get(),
                'product' => $res->get(),
                'quantity' => $res_quantity->get()
            ];
           
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        //
    }
}