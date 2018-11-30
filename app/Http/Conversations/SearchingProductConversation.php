<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use App\ProductVersion;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Attachments\Image;
use Illuminate\Support\Facades\Response;

class SearchingProductConversation extends Conversation
{
    public $index = 0;

    public function askProductType(){
        $this->say('Chúng ta hãy cùng đi tìm trang phục phù hợp nhất với yêu cầu của bạn nào!');
        $this->say('Trong quá trình tìm kiếm, nếu bạn muốn quay lại câu hỏi lúc trước, hãy gõ "Quay lại" nhé.');
        $question = Question::create('Đầu tiên, hãy cho mình biết loại trang phục bạn đang tìm kiếm? Ví dụ như áo sơ mi, quần tây, ...')
            ->callbackId('select_product_type');
        
        $this->ask($question, function(Answer $answer){
            $this->bot->userStorage()->save([
               'product_type' => $answer->getText(),
            ]);
            $this->askColor();
        });

    }

    /** */
    public function askColor(){
        $question = Question::create('Hãy mô tả màu sắc bạn muốn? Ví dụ: đỏ nhạt, xanh rêu, hồng chấm bi, ...')
            ->callbackId('select_color');

        $this->ask($question, function(Answer $answer){
            if($this->undo(0, $answer->getText())){
                return false;
            };
            $this->bot->userStorage()->save([
               'color' => $answer->getText(),
            ]);
            $this->askSize();
        });
    }

    /** */
    public function askSize(){
        $link = '';
        $question = Question::create('Size của bạn là gì? Nếu bạn chưa rõ, hãy bấm vào nút phía dưới để tham khảo rồi trả lời mình nhé.')
            ->callbackId('select_size')
            ->addButton(Button::create('Hướng dẫn chọn size phù hợp')->value(''));

        $this->ask($question, function(Answer $answer){
            if($this->undo(1, $answer->getText())){
                return false;
            };
            if($answer->isInteractiveMessageReply()){
                return view($link);
            }
            $this->bot->userStorage()->save([
               'size' => $answer->getText(), 
            ]);
            $this->askMaterial();
        });
    }

    /** */
    public function askMaterial(){
        $link = '';
        $question = Question::create('Chất liệu phù hợp nhất với bạn? Ví dụ: len, cotton, ...')
            ->callbackId('select_material')
            ->addButton(Button::create('Hướng dẫn chọn chất liệu trang phục')->value(''));

        $this->ask($question, function(Answer $answer){
            if($this->undo(2, $answer->getText())){
                return false;
            };
            if($answer->isInteractiveMessageReply()){
                return view($link);
            }
            $this->bot->userStorage()->save([
               'material' => $answer->getText(), 
            ]);
            $this->askBrand();
        });
    }

    /** */
    public function askBrand(){
        $question = Question::create('Không biết là bạn có đang tìm kiếm thương hiệu thời trang nào không nhỉ? Hãy cho mình biết nào!')
            ->callbackId('select_brand');

        $this->ask($question, function(Answer $answer){
            if($this->undo(3, $answer->getText())){
                return false;
            };
            $this->bot->userStorage()->save([
               'brand' => $answer->getText(), 
            ]);
            $this->askPrice();
        });
    }

    /** */
    public function askPrice(){
        $question = Question::create('Hầu bao luôn ảnh hưởng khá nhiều đến sự lựa chọn của chúng ta. Hãy chọn khoảng giá bạn mong muốn!')
            ->callbackId('select_price')
            ->addButtons([
                Button::create('50,000 - 200,000')->value('50000,200000'),
                Button::create('200,000 - 350,000')->value('200000,350000'),
                Button::create('350,000 - 500,000')->value('350000,500000'),
            ]);

        $this->ask($question, function(Answer $answer){
            if($this->undo(4, $answer->getText())){
                return false;
            };
            if($answer->isInteractiveMessageReply()){
                $this->bot->userStorage()->save([
                   'price' => $answer->getValue(),
                ]);
                $price_smaller = explode(',', $answer->getValue())[0];
                $price_greater = explode(',', $answer->getValue())[1];
                $this->say($price_smaller . ' - ' . $price_greater);
            }
            else{
                $this->repeat("Bạn vui lòng chọn một trong các khoảng giá ở trên.");
            }
            $this->askDescription();
        });
    }

    /** */
    public function askDescription(){
        $this->say('Có lẽ những điều trên chưa đủ để mô tả yêu cầu của bạn.');
        $question = Question::create('Nếu bạn có thêm mô tả gì, hãy viết thật ngắn gọn nhé :P Nếu không, hãy gõ "Không"')
            ->callbackId('select_size');

        $this->ask($question, function(Answer $answer){
            if($this->undo(5, $answer->getText())){
                return false;
            };
            $t = $answer->getText();
            if($t!='Không'||$t!='không'||$t!='k'||$t!='K'||$t!='ko'||$t!='khong'||$t!='Khong'){
                $this->bot->userStorage()->save([
                    'description' => $answer->getText(), 
                ]);
            }
            $this->showResult();
        });
    }

    /** */
    public function search(){
        $condition = $this->bot->userStorage()->find();
        $price_smaller = explode(',', $condition->get('price'))[0];
        $price_greater = explode(',', $condition->get('price'))[1];
        $data = ProductVersion::where('content', 'LIKE', '%' . $condition->get('product_type') . '%')
            // ->where('status', '=', '1') //in stock
            ->where('content', 'LIKE', '%' . $condition->get('color') . '%')
            ->where('content', 'LIKE', '%' . strtoupper($condition->get('size')) . '%')
            ->where('content', 'LIKE', '%' . $condition->get('material') . '%')
            ->where('price', '<=', $price_greater)
            ->where('price', '>=', $price_smaller)
            ->where('content', 'LIKE', '%' . $condition->get('brand') . '%')
            ->orWhere('content', 'LIKE', '%' . $condition->get('description') . '%')
            ->get();
        return $data;
    }

    public $sequence = 0;
    /** */
    public function showResult(){
        $sequence = 0;
        $data = $this->search();      
        $count = count($data);

        if($count == 0){
            $this->say('Đã tìm thấy ' . $count . ' sản phẩm.');
            return;
        }

        $this->say('Đã tìm thấy ' . $count . ' sản phẩm.');

        $image = new Image(asset('/uploads' . '/' . $data[0]->image), [
            'custom_payload' => true,
        ]);
        $this->say(OutgoingMessage::create('Đây là một trong các sản phẩm phù hợp với yêu cầu của bạn.')
                    ->withAttachment($image));

        $product = 'Tên sản phẩm : ' . $data[$sequence]->name . '<br>';
        $product .= 'Nhãn hiệu : ' . $data[$sequence]->brand . '<br>';
        $product .= 'Màu sắc : ' . $data[$sequence]->color . '<br>';
        $product .= 'Kích thước : ' . $data[$sequence]->size . '<br>';
        $product .= 'Chất liệu : ' . $data[$sequence]->material . '<br>';
        $product .= '------------------------------------ <br>';
        
        $this->say($product);
        $question = Question::create('')
            ->callbackId('select_option')
            ->addButtons([
                Button::create('Cho vào giỏ hàng')->value('cart'),
                Button::create('Xem thêm sản phẩm khác')->value('other_product')
            ]);
        $this->ask($question, function(Answer $answer){
            if($answer->isInteractiveMessageReply()){
                switch($answer->getValue()){
                    case 'cart':
                        //save into cart
                        $this->say($data[$sequence]->name . ' đã được cho vào giỏ hàng của bạn.');
                        break;
                    case 'other_product':
                        $this->$sequence++;
                        $this->showResult();
                        break;
                }
                
            }
        });
    }

    /** */
    public function undo($index, $answer){
        if($answer=='Quay lại'||$answer=='quay lại'||$answer=='quay lai'||$answer=='QUAY LẠI'){
            $this->undo_list($index);
            return true;
        }
        return false;
    }

    /** */
    public function undo_list($index){
        switch($index){
            case 0:
                $this->askProductType();
                break;
            case 1:
                $this->askColor();
                break;
            case 2:
                $this->askSize();
                break;
            case 3:
                $this->askMaterial();
                break;
            case 4:
                $this->askBrand();
                break;
            case 5:
                $this->askPrice();
                break;
            case 6:
                $this->askDescription();
                break;
        }
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askProductType();
    }
}
