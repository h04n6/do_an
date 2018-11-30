<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Validator;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use Illuminate\Support\Facades\Redirect;
use App\Http\Conversations\CustomElement;

class OnboardingConversation extends Conversation
{
    public function askHelp(){
        $question = Question::create('Chào mừng bạn đến với HVC Fashion. Bạn cần hỗ trợ gì?')
            ->callbackId('select_help')
            ->addButtons([
                Button::create('Tư vấn')->value('advisory'),
                Button::create('Tham quan, mua sắm')->value('purchase'),
                Button::create('Nhận tin khuyến mãi hấp dẫn')->value('promote'),
            ]);

        $this->ask($question, function(Answer $answer){
            if($answer->isInteractiveMessageReply()){
                switch($answer->getValue()){
                    case 'purchase':
                        $this->bot->startConversation(new PurchaseConversation());
                        break;
                    case 'advisory':
                        $this->bot->startConversation(new AdvisoryConversation());
                        break;
                    case 'promote':
                        $this->bot->startConversation(new PromoteConversation());
                        break;
                }
            }
        });
    }

    public function test(){
        // $html = file_get_contents(asset('/assets/chatbot/test.html'));
        // var_dump($html);
        //$html = CustomElement::test();
        //$html = '<a target="_blank" rel="noopener noreferrer" href="https://google.com/">https://google.com/</a>';
        $this->say($html);
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        //Redirect::to('https://google.com/');
        $this->askHelp();
    }

    /** */
    public function originateConversation(){
        $this->say('xin chào');
    }
}
