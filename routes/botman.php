<?php
use App\Http\Controllers\BotManController;
use App\Http\Conversations\MakeConversation;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ListTemplate;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\BotMan;
use Illuminate\Support\Facades\Session;
use App\ChatbotScript;

// if(Session::has('user_id')){
//     $user_id = Session::get('user_id');
// }

// $user_id = '';

$botman = resolve('botman');

// $botman->hears('hello', function ($bot) {
//     $bot->reply('Hello!');
// });
// $botman->hears('Start conversation', BotManController::class.'@startConversation');

//$botman->say('Xin chào', $bot->getUser()->getId(), BotManController::class);

$xin_chao = 'xin chào';
$botman->hears('h', function($bot, $xin_chao){
    $bot->reply($xin_chao);
});

$botman->hears('hi', BotManController::class.'@startConversation');

$botman->hears('.*(địa chỉ|ở đâu|mua ở|mua hàng ở).*', BotManController::class.'@askAddress');

$botman->hears('.*(tìm|mua|xem|cần) {text}', BotManController::class.'@askProduct');

$botman->fallback(function(BotMan $bot) {
    $bot->reply('Mình không hiểu lắm, bạn có thể nói rõ hơn được không?');
});


$data = ChatbotScript::where('status', '=', '1')->get();

foreach($data as $key_data=>$d){
    $key_words = explode(',', $d->key_word);
    $key_word = '';
    foreach($key_words as $k){
        $key_word .= $k . '|';
    }
    $key_word = substr($key_word, 0, strlen($key_word) - 1);
    $id = $d->id;
    include(app_path(). '/Http/Conversations/MakeConversation.php');
};
