$(document).ready(function(){
    showScript();
    $('table tbody tr:first').click();
    addNewScript();
});

function showScript(){
    $('.tr-script').click(function(){
        //set background-color
        $('.tr-script').each(function(){
            $(this).removeClass('choosed-row');
        });
        $(this).addClass('choosed-row');

        //clear old data
        $('.chat').html('');
        $('.key-words-container').html('');
        $('.kwcontainer').html('');

        var id = $(this).find('td.id').text();
        $.get(url + '/' + id, function(data){
            $('.name').val(data.name);

            index = 0;
            $('.even').html('');
            $('.odd').html('');

            var scripts = (data.script).split(',');
            scripts.forEach(script => {
                var text = script.split(':');
                if(text[0] == '1'){
                    createVisitorChat(text[1]);
                    //addKeyWordContainer();
                }
                else{
                    createChatBotChat(text[1]);
                }
            });

            var key_words = (data.key_word).split(',');
            key_words.forEach(key_word => {
                createKeyWord(key_word);
                index++;
            })
        })
    });
}

function enableScript(){
    $('.ckb').each(function(){
        if($(this).prop(':checked')){
            
        }
    });
}
