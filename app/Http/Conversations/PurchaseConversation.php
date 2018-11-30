<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class PurchaseConversation extends Conversation
{
    public function showRecommendProduct(){
        $image = new Image('https://botman.io/img/logo.png', [
            'custom_payload' => true,  
        ]);         

        $message = OutgoingMessage::create('Đây là chương trình khuyến mãi gần đây nhất trong tháng này của cửa hàng mình.')
                    ->withAttachment($image);

        $this->bot->reply($message);
        $this->askChooseRecommendProduct();
    }

    public function askChooseRecommendProduct(){
        $question = Question::create('')
            ->callbackId('choose_recommend_product')
            ->addButtons([
                Button::create('Xem chi tiết chương trình khuyến mãi')->value('promote'),
                Button::create('Tìm theo ý thích')->value('custom'),
            ]);
        
        $this->ask($question, function(Answer $answer){
            if($answer->isInteractiveMessageReply()){
                if($answer->getValue() == 'promote'){
                    $this->say('Rất tiếc, hiện tại chương trình khuyến mãi chưa quản lý được.');
                }else{
                    $this->bot->startConversation(new SearchingProductConversation());
                }   
            }
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->showRecommendProduct();
    }
}
