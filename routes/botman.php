<?php
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ListTemplate;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\BotMan;
use Illuminate\Support\Facades\Session;

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

$botman->hears('hi', BotManController::class.'@startConversation');

$botman->hears('.*(địa chỉ|ở đâu|mua ở|mua hàng ở).*', BotManController::class.'@askAddress');

$botman->hears('.*(tìm|mua|xem|cần) {text}', BotManController::class.'@askProduct');

$botman->fallback(function(BotMan $bot) {
    $bot->reply('Mình không hiểu lắm, bạn có thể nói rõ hơn được không?');
});

