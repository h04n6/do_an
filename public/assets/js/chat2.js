
function countNumberSentence(){
    var c = 0;
    if($('li').length){
        $('ol.chat li.chatbot').each(function(){
            c++;
        });
    }


    $('#count-msg').text('Số câu trả lời của chatbot là : ' + c);
}

setInterval(function(){
    countNumberSentence();
}, 100);