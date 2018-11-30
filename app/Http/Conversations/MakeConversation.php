<?php

use BotMan\BotMan\BotMan;

class MakeConversation
{
    public static function hears($botman, $question, $answer){
        $botman->hears($text, function(BotMan $bot){
            $bot->reply($answer);
        });
    }
}
