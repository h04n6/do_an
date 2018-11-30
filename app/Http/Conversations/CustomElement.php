<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;

class CustomElement extends Conversation
{
    public static function test(){
        return 'Whatever you\'re testing, it\'s okay';
    }

    /** */
    public static function checkbox($id, $class, $name, $value){
        return '<input type="checkbox" id="' . $id . '" class="' . $class . '" name="' . $name . '" value="' . $value . '">';
    }

    /** */
    public static function link($url, $name){
        return '<a target="_blank" rel="noopener noreferrer" href="' . $url . '">' . $name . '</a>';
    }

    /** */
    public static function productForm($prd_img, $prd_name, $prd_price){
        $table_style = 'border:0.8px solid gray;border-radius:6px;margin:3px 3px;padding:5px 5px';
        $img_style = 'height:80px;width:60px;border:0.5px solid gray;border-radius:6px;';
        $td_style = 'padding:3px 5px;';
        $html = '<table style="' . $table_style . '">
                    <tbody>
                        <tr>
                            <td rowspan="2"><img alt="icon" style="' . $img_style . '" src="http://127.0.0.1:8000/' . $prd_img . '")}}"></td>
                            <td style="' . $td_style . '">' . $prd_name . '</td>
                        </tr>
                        <tr>
                            <td style="' . $td_style . '">Giá: ' . number_format($prd_price) . ' đồng</td>
                        </tr>
                    </tbody>
                </table>';
        return $html;
    }

    /** */
    public static function table_2_column($data, $urls, $bool){
        $table_style = 'border:0.8px solid gray;border-radius:6px;margin:3px 3px;padding:3px 3px;';
        $td_style = 'padding: 3px 5px;';
        $td_left_style = 'border-right:0.8px solid gray;';

        $tr = '';
        for($i = 0; $i < count($data); $i+=2){
            if($i+1 < count($data)){
                $tr .= '<tr>';
                if($bool == true){
                    $tr .= '<td style="' . $td_style . $td_left_style . '">' . link($urls[$i], $data[$i]) . '</td>
                            <td style="' . $td_style . '">' . link($urls[$i+1], $data[$i+1]) . '</td>
                        </tr>';
                }
                else{
                    $tr .= '<td style="' . $td_style . $td_left_style . '">' . $data[$i] . '</td>
                            <td style="' . $td_style . '">' . $data[$i+1] . '</td>
                        </tr>';
                }
            }  
        }

        $html = '<table style="' . $table_style . '">
                    <tbody>
                        ' . $tr . '
                    </tbody>
                </table>';

        return $html;
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