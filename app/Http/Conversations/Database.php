<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use App\Color;
use App\Size;
use App\TypeProducts;
use App\Manufacture;
use App\Products;
use App\ProductDetail;

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
        if($type != '' || $size != '' || $color != '' || $brand != ''){
            $res = Products::with('productDetail', 'productSize', 'productColor');
            if($type != ''){
                $res = $res->where('id_type', '=', $type);
            }
            if($color != ''){
                $res = $res->where('id_color', '=', $color);
            }
            if($size != ''){
                $res = $res->where('id_size', '=', $size);
            }
            if($brand != ''){
                $res = $res->where('id_manufacturer', '=', $brand);
            }

            return $res->get();
        }    
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