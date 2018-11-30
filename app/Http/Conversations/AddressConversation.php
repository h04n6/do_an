<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use App\Http\Conversations;

class AddressConversation extends Conversation
{
    /** */
    public function askUserLocation(){
        $question = Question::create('Bạn đang ở tỉnh/thành phố nào ạ?')
            ->callbackId('select_location');
    }

    /** */
    public function address($index){
        switch($index){
            case 0:
                return 'Kí túc xá C5, trường ĐH Hàng Hải';
            case 1:
                return 'Số 212 đường Miếu Hai Xã, Lê Chân';
        }
    }

    /** */
    public function direction($index){
        switch($index){
            case 0:
                return 'https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+%C4%90%E1%BA%A1i+h%E1%BB%8Dc+H%C3%A0ng+h%E1%BA%A3i+Vi%E1%BB%87t+Nam/@20.8368589,106.69202,17z/data=!3m1!4b1!4m5!3m4!1s0x314a7a9c2ee478df:0x6039ffe1614ede5c!8m2!3d20.8368539!4d106.6942087';
            case 1:
                return 'https://www.google.com/maps/place/212+Mi%E1%BA%BFu+Hai+X%C3%A3,+D%C6%B0+H%C3%A0ng,+L%C3%AA+Ch%C3%A2n,+H%E1%BA%A3i+Ph%C3%B2ng,+Vi%E1%BB%87t+Nam/@20.8427161,106.6755821,17z/data=!3m1!4b1!4m5!3m4!1s0x314a7a870b54a3cf:0xff2aa511e670f6ef!8m2!3d20.8427111!4d106.6777708';
        }
    }

    /** */
    public function selectAddress($answer){
        //
    }

    /** */
    public function answerAddress(){
        $this->say('Cửa hàng mình nhận <b>ship hàng toàn quốc</b> và hiện tại có 2 chi nhánh tại Hải Phòng.'
        . '<br> - ' . CustomElement::link($this->direction(0), $this->address(0))
        . '<br> - ' . CustomElement::link($this->direction(1), $this->address(1)));
        $this->say('Bạn có thể bấm vào địa chỉ để xem bản đồ. Mình rất vui khi bạn ghé qua ạ!');
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->answerAddress();
    }
}