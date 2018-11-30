<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Validator;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use App\Account;

class RegistrationConversation extends Conversation
{
    public $state = 'new';

    /** */
    public function startRegister(){
        $this->say('Sau đây mình sẽ giúp bạn đăng ký 1 tài khoản tại HVC Fashion.');
        $this->askEmail();
    }

    /** */
    public function askEmail(){
        $question = Question::create('Hãy cung cấp cho mình email của bạn. Email của bạn sẽ được sử dụng làm tên tài khoản của bạn tại HVC Fashion.')
            ->callbackId('select_email');
        
        $this->ask($question, function(Answer $answer){
            $validator = Validator::make(['email' => $answer->getText()], [
                'email' => 'email',
            ]);

            if($validator->fails()) return $this->repeat('Đây không giống như một địa chỉ email. Mời bạn vui lòng nhập lại!');

            $test = Account::where('email', '=', $email)->get();
            if(count($test) == 0) return $this->repeat('Email này đã được sử dụng. Bạn vui lòng nhập email khác.');

            $this->bot->userStorage()->save([
                'email' => $answer->getText(),
            ]);

            $this->askPassword();
        });
    }

    /** */
    public function askPassword(){
        $question = Question::create('Bạn hãy nhập mật khẩu cho tài khoản của bạn. Mật khẩu gồm 6 - 16 ký tự.')
            ->callbackId('select_password');
        
        $this->ask($question, function(Answer $answer){
            $this->bot->userStorage()->save([
                'password' => $answer->getText(),
            ]);
            $this->askConfirmPassword();
        });
    }

    /** */
    public function askConfirmPassword(){
        $question = Question::create('Bạn hãy nhập lại mật khẩu để xác nhận mật khẩu.')
            ->callbackId('select_password')
            ->addButton(Button::create('Đổi mật khẩu')->value('change_password'));
        
        $this->ask($question, function(Answer $answer){
            if($answer->isInteractiveMessageReply()){
                $this->askPassword();
            }else{
                if($this->bot->userStorage()->find->get('password') != $answer->getValue()){
                    $this->repeat('Xác nhận mật khảu không đúng. Mời bạn xác nhận lại.');
                }else{
                    $this->bot->userStorage()->save([
                        'confirm_password' => $answer->getText(),
                    ]);
                    $this->askName();
                }
            }
        });
    }

    /** */
    public function askName(){
        $question = Question::create('Tên của bạn là?')
            ->callbackId('select_name');
        
        $this->ask($question, function(Answer $answer){
            $this->bot->userStorage()->save([
                'name' => $answer->getText(),
            ]);
            $this->askAddress();
        });
    }

    /** */
    public function askAddress(){
        $question = Question::create('Hãy nhập địa chỉ của bạn. Đây sẽ là địa chỉ mà mình gửi hàng cho bạn. Bạn có thể thêm các địa chỉ khác trong phần cài đặt sau khi tạo tài khoản.')
            ->callbackId('select_address');
        
        $this->ask($question, function(Answer $answer){
            $this->bot->userStorage()->save([
                'address' => $answer->getText(),
            ]);
            $this->finishRegister();
        });
    }

    /** */
    public function askPolicy(){
        $policy = 'chính sách về tài khoản: ... ';
        $question = Question::create('Bằng việc gõ "OK", bạn đồng ý với các chính sách của HVC Fashion. Nếu không đồng ý, gõ "K" và bạn sẽ thoát khỏi quá trình lập tài khoản.')
            ->callbackId('select_policy')
            ->addButtons([
                Button::create('Xem chính sách')->value('see_policy'),
            ]);
        $this->ask($question, function(Answer $answer){
            if($answer->isInteractiveMessageReply()){
                return view(''); //view policy
            }
            $t = $answer->getValue();
            if($t=='OK'||$t=='ok'||$t=='uk'||$t=='Ok'||$t=='oK'){
                $this->finishRegister();
            }
            else if($t=='K'||$t=='ko'||$t=='k'||$t=='Ko'||$t=='Không'||$t=='Khong'||$t=='khong'){
                $this->say('Bạn không đồng ý với điều khoản của HVC Fashion');
            }
            else{
                $this->repeat('Câu trả lời của bạn phải là "OK" hoặc "K"');
            }
        });
    }

    /** */
    public function finishRegister(){
        $this->saveData();
        $name = $this->bot->userStorage()->find()->get('name');
        $greeting = 'Đăng ký tài khoản thành công. Cảm ơn bạn ' . $name  . ' dã đăng ký tài khoản tại HVC Fashion. ';
        switch($state){
            case 'new':
                $this->say($greeting . 'Hãy hưởng thụ niềm vui mua sắm ở HVC Fashion bằng tài khoản này nhé ^^!');
                break;
            case 'ordering':
                $this->say($greeting . 'Chúng ta tiếp tục với đơn hàng của bạn nào ^^!');
                break;
        }
    }

    /** */
    public function saveData(){
        $user = $this->bot->userStorage()->find();
        $a = new Account();
        $a->email = $user->get('email');
        $a->password = $user->get('password');
        $a->address = $user->get('address');
        $a->name = $user->get('name');

        $a->save();
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->startRegister();
    }
}
