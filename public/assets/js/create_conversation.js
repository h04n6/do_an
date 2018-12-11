$(document).ready(function(){
    inputMessage();
    save();
    delScript();
    scroll2Div();
    setKeyWord();
})

/** */
function createVisitorChat($text){
    var last_li = 'ul.chat li.visitor:last-child';
    var last_li_chatbot = 'ul.chat li.chatbot:last-child';

    if($(last_li_chatbot).find('textarea.chatbot-answer').val() == ''){
        $(last_li_chatbot).remove();
    }

    $($.parseHTML('<li>'))
        .addClass('visitor')
        .appendTo('ul.chat');

    $($.parseHTML('<div>'))
        .addClass('msg')
        .appendTo(last_li);

    $($.parseHTML('<textarea>'))
        .addClass('visitor-chat')
        .val($text)
        .appendTo(last_li + ' div.msg');
}

/** */
function createChatBotChat($text){
    var last_li = 'ul.chat li.chatbot:last-child';

    $($.parseHTML('<li>'))
        .addClass('chatbot')
        .appendTo('ul.chat');

    $($.parseHTML('<div>'))
        .addClass('msg-chatbot')
        .appendTo(last_li);

    $($.parseHTML('<textarea>'))
        .addClass('form-control chatbot-answer')
        .val($text)
        .attr('rows', '3')
        .attr('placeholder', 'Chatbot trả lời ...')
        .appendTo(last_li + ' div.msg-chatbot');

    $($.parseHTML('<input>'))
        .attr('type', 'button')
        .attr('value', 'Thêm')
        .addClass('btn btn-primary')
        .attr('id', 'btn-add-chatbot-answer')
        .appendTo(last_li + ' div.msg-chatbot');

    addChatbotAnswer();
    delScript();

    //$('.btn-add-chatbot-answer').closest('textarea.chatbot-answer').focus();
}

/** */
function inputMessage(){
    $('#msg-input').keydown(function(e){
        if(e.keyCode == 13){
            createVisitorChat($(this).val());
            createChatBotChat('');
            $(this).val('');
            //addKeyWordContainer();
        }
    });
}

/** */
function addChatbotAnswer(){
    $('#btn-add-chatbot-answer').click(function(){
        $(this).remove();
        createChatBotChat('');
    });
}

/** */
function delScript(){
    $('li.chatbot').dblclick(function(){
        $(this).remove();
    });

    $('li.visitor').dblclick(function(){
        var index = $(this).index();
        console.log(index);
        $('.key-word-container').each(function(){
            console.log($(this).index());
            if($(this).index() === index){
                $(this).remove();
                return false;
            };
        });

        $(this).remove();
    });
}

/** */
function addKeyWordContainer(){
    // $('div.key-word-container').each(function(){
    //     $(this).remove();
    // });
    createKeyWordContainer($('ul.chat li.visitor:last div.msg').position().top);

    //set the same height for 2 div
    var h = $('ul').outerHeight();
    $('.kwcontainer').height(h);
}

/** */
function createKeyWordContainer(t){
    var last_div = 'div.kwcontainer div.key-word-container:last';

    $($.parseHTML('<div>'))
        .addClass('key-word-container')
        .appendTo('div.kwcontainer')
        .css({
            top: t,
        });

    $($.parseHTML('<input>'))
        .addClass('input-key-word')
        .addClass('form-control')
        .attr('type', 'text')
        .attr('placeholder', 'Nhập từ khóa ...')
        .appendTo(last_div);

    setKeyWord();
}

/** */
function setKeyWord(){
    $('#input-key-word').keydown(function(e){
        if(e.keyCode == 188){
            createKeyWord($(this).val());
        }
    });

    $('#input-key-word').keyup(function(e){
        if(e.keyCode == 188){
            $(this).val('');
        }
    });
}

/** */
// function createKeyWord(input_element){
//     var container = input_element.parent();

//     container.append(
//         $($.parseHTML('<div>'))
//             .addClass('input-group mb-3')
//     );

//     // var last_input_group = container + ' .input-group:last';
//     // var last_input_group_addon = container + ' .input-group:last .input-group-addon:last';

//     var input_group = input_element.parent().find('.input-group:last');
    
//     input_group.append(
//         $($.parseHTML('<input>'))
//             .attr('type', 'text')
//             .attr('disabled', 'disabled')
//             //.attr('readonly', 'readonly')
//             .attr('aria-describedby', 'basic-addon')
//             .val(input_element.val())
//             .addClass('key-word form-control')
//     );

//     input_group.append(
//         $($.parseHTML('<div>'))
//             .addClass('input-group-addon')
//     );

//     var input_group_addon = input_element.parent().find('.input-group:last .input-group-addon');
    
//     input_group_addon.append(
//         $($.parseHTML('<span>'))
//             .attr('id', 'basic-addon')
//             .addClass('input-group-text')
//             .html('x')
//     );

//     delKeyWord();

// }

var index = 0;

/** */
function createKeyWord(text){
    var container = index%2 == 0 ? 'div.even' : 'div.odd';

    $($.parseHTML('<div>'))
        .addClass('input-group mb-3')
        .appendTo(container);
    

    var last_input_group = container + ' .input-group:last';
    var last_input_group_addon = container + ' .input-group .input-group-addon:last';

    // var input_group = input_element.parent().find('.input-group:last');
    
    $($.parseHTML('<input>'))
        .attr('type', 'text')
        .attr('disabled', 'disabled')
        //.attr('readonly', 'readonly')
        .attr('aria-describedby', 'basic-addon')
        .val(text)
        .addClass('key-word form-control')
        .appendTo(last_input_group);

    $($.parseHTML('<div>'))
        .addClass('input-group-addon')
        .appendTo(last_input_group);
    

    //var input_group_addon = input_element.parent().find('.input-group:last .input-group-addon');
    
    $($.parseHTML('<span>'))
        .attr('id', 'basic-addon')
        .addClass('input-group-text')
        .html('x')
        .appendTo(last_input_group_addon);
    
    delKeyWord();

    index++;
}

/** */
function delKeyWord(){
    $('.input-group-addon').click(function(){
        $(this).closest('div.input-group').remove();
        // alert('xin chào');
        // $(this).parent().remove();
    });
}

// /** */
// function createChatbotChatEditing(){
//     //
// }

// /** */
// function getText(element){
//     if(element.tagName === "TEXTAREA" || 
//     (element.tagName === "INPUT" && element.type === "text")) {
//         return element.value.substring(element.selectionStart, element.selectionEnd);
//     }
//     return null;
// }

// /** */
// setInterval(function(){
//     var txt = getText($(':focus'));
//     //txt === null ? 'no input selected' : txt;
//     //$('#div').html(txt);
//     //console.log(txt);
// }, 100);

function save(){
    $('#myForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
          e.preventDefault();
          return false;
        }
      });

    //event submit
    $('#myForm').submit(function(){
        var saved_key_word = '';
        var saved_script = '';

        // $('#btn-status').val('update');

        $('.key-word').each(function(){
            saved_key_word += $(this).val() + ',';
        });

        $('.chat li').each(function(){
            $(this).attr('class') == 'visitor' ? 
                saved_script += '1:' + $(this).find('textarea.visitor-chat').val() + ',' :
                saved_script += '2:' + $(this).find('textarea.chatbot-answer').val() + ',';
        });

        $('#saved-key-word').val(delCommaAtTheEnd(saved_key_word));
        $('#saved-script').val(delCommaAtTheEnd(saved_script));
        $('#id-script').val($('table tbody tr.choosed-row td.id').text());
        $('table tbody tr.choosed-row td input.ckb').is(':checked') ? $('#enabled-script').val('1') : $('#enabled-script').val('0');
        

        switch(''){
            case $('.name').val():
                alert('Phải đặt tên cho kịch bản mới!');
                $('.name').focus();
                return false;

            case saved_key_word:
                alert('Phải có ít nhất 1 từ khóa!');
                $('#input-key-word').focus();
                return false;

            case saved_script:
                alert('Phải tạo nội dung trò chuyện!');
                $('#msg-input').focus();
                return false;
        }
    });
}

/** */
function delCommaAtTheEnd($text){
    return $text.substring(0, $text.length - 1);
}

/** */
function addNewScript(){
    $('#btn-add-new-script').click(function(){
        $('.chat-frame-body ul.chat').html('');
        $('.name').val('');
        $('.even').html('');
        $('.odd').html('');
        if($(this).val() == 'Tạo mới'){
            $(this).val('Lưu');
            $('#btn-cancel-script').removeClass('hidden');
            $('#btn-status').val('save');
        }else{
            $(this).val('Tạo mới');
            $('#btn-cancel-script').addClass('hidden');
            $('#btn-update-script').click();
            //$('#btn-status').val('create');
        }
    });

    $('#btn-cancel-script').click(function(){
        $('table tbody tr:first').click();
        $('#btn-add-new-script').val('Tạo mới');
        $(this).addClass('hidden');
    })
}

/** */
function scroll2Div(){
    $('#myForm div').on('scroll', function(e){
        var element = $(e.currentTarget);
        var left = element.scrollLeft();
        var top = element.scrollTop();
        if(element.attr('class') === 'chat-frame-body'){
            $('.kwcontainer-father').scrollTop(top);
            $('.kwcontainer-father').scrollLeft(left);
        }
        else{
            $('.chat-frame-body').scrollTop(top);
            $('.chat-frame-body').scrollLeft(left);
        }
    });
}
