<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use App\Http\Conversations\Database;
use App\Http\Conversations\CustomElement;
use App\Http\Conversations\MoreDetailType;
use App\ProductVersion;

class SearchProductConversation extends Conversation
{
    public static function test(){
        return 'Whatever you\'re testing, it\'s okay';
    }

    protected $t = '';

    public function __construct($text)
    {
        $this->t = $text;
    }

    /** */
    public function importantProperties($array){
        return $array;
    }

    /** */
    public function analyze($data){
        $prd_ts = Database::getProductType();
        $prd_cs = Database::getColor();
        $prd_ss = Database::getSize();
        $prd_bs = Database::getBrand();

        //ids
        $res_t = '';
        $res_c = '';
        $res_s = '';
        $res_b = '';

        foreach($prd_ts as $t){
            if (strpos($data, $t->name) !== false){
                $res_t = $t->id;
                break;
            }
        }
        if($res_t == ''){
            if(strpos($data, 'áo')!== false || strpos($data, 'quần')!== false || strpos($data, 'váy')!== false){
                $res_t = 'more_details';
            }
        }

        foreach($prd_cs as $c){
            if (strpos($data, $c->name) !== false){
                $res_c = $c->id;
                break;
            }
        }

        foreach($prd_ss as $s){
            if (strpos($data, $s->name) !== false){
                $res_s = $s->id;
                break;
            }
        }

        foreach($prd_bs as $b){
            if (strpos($data, $b->name) !== false){
                $res_b = $b->id;
                break;
            }
        }

        $res = array(
            't' => $res_t,
            //'t_name' => $res_t_name,
            'c' => $res_c,
            's' => $res_s, 
            'b' => $res_b);

        $this->importantProperties($res);
        return $res;
    }

    /** */
    public function execute($data){
        switch($data['t']){
            case 'more_details':
                $this->ifBlankType('more_details');
                break;
            case '':
                $this->ifBlankType('');
                break;
        }

        // switch(''){
        //     case $data['b']:
        //         $this->ifBlankBrand();
        //         break;
        //     case $data['c']:
        //         $this->ifBlankColor();
        //         break;
        //     case $data['s']:
        //         $this->ifBlankSize();
        //         break;
        // }

        $res = Database::getProducts($data['t'], $data['c'], $data['s'], $data['b']);

        $this->say(
            // 'Mình đã tìm thấy ' . count($res) . ' sản phẩm phù hợp với yêu cầu của bạn. <br>' .
            // 'Dưới đây là sản phẩm nổi bật nhất trong số đó. <br>' .
            CustomElement::productForm($res[0]->image, $res[0]->name, $res[0]->price
        ));
    }

    /** */
    public function ifBlankBrand(){
        $this->say('Rất tiếc mình không kinh doanh nhãn hiệu này. Dưới đây là những nhãn hiệu cửa hàng mình đang kinh doanh:');
        $prd_bs = Database::getBrand();
        $bs = [];
        foreach($prd_bs as $b){
            $bs[] = $b->name;
        }
        
        $this->say(CustomElement::table_2_column($bs, '', false));
    }

    /** */
    public function ifBlankType($state){
        $greeting = '';
        if($state == ''){
            $greeting = 'Rất tiếc mình không có loại trang phục bạn cần. ';
        }
        else{
            $greeting = 'Bạn có thể miêu tả rõ hơn không? ';
            //$this->bot->startConversation(new MoreDetailType($this->importantProperties()));
        }
        $this->say($greeting . 'Dưới đây là những loại trang phục cửa hàng mình đang kinh doanh:');
        $prd_ts = Database::getProductType();
        $ts = [];
        foreach($prd_ts as $t){
            $ts[] = $t->name;
        }
        
        $this->say(CustomElement::table_2_column($ts, '', false));
    }

    /** */
    public function ifBlankColor(){
        //
    }

    /** */
    public function ifBlankSize(){
        //
    }

    /** */
    public function moreDetail(){
        
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->execute($this->analyze($this->t));
    }
}