$(document).ready(function(){
    showScript();
    $('table tbody tr:first').click();
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

            var scripts = (data.script).split(',');
            scripts.forEach(script => {
                var text = script.split(':');
                if(text[0] == '1'){
                    createVisitorChat(text[1]);
                    addKeyWordContainer();
                }
                else{
                    createChatBotChat(text[1]);
                } 
            });
            
            //addKeyWordContainer();
        })
    });
}

function enableScript(){
    $('.ckb').each(function(){
        if($(this).prop(':checked')){
            
        }
    });
}
