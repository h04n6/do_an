<?php

namespace App\Http\Conversations;

use BotMan\BotMan\BotMan;
use App\ChatbotScript;

$data = ChatbotScript::where('id', '=', $i)->first();
    $text = explode(',', $data->script);
    foreach($text as $key_text=>$t){
        $text_2 = explode(':', $t);
        if($text_2[0] == '2'){
            $bot->reply($text_2[1]);
    }
    
}
