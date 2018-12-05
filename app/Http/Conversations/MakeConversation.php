<?php

namespace App\Http\Conversations;

use BotMan\BotMan\BotMan;

$botman->hears('.*' . $key_word . '.*', function(BotMan $bot) use ($id){
    $i = $id;
    include('MakeReply.php');
});
