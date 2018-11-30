
<footer class="main-footer">
    <div class="footer text-muted">
        <p><i class="fa fa-copyright"></i> - Phát triển bởi team Cương Hoàng Vân</p>
    </div>
</footer>

<script>
//    // Default initialization
//    $(".styled, .multiselect-container input").uniform({
//        radioClass: 'choice'
//    });
    $('.delete').click(function () {
    confirm('{!!trans('base.arlet')!!}') ? $(this).parent().submit() : false;
    });
    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
    autoWidth: false,
            columnDefs: [{
            orderable: false,
                    width: '100px',
                    targets: [ 5 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
            search: '<span>' + '{!!trans('base.search')!!}' + ':</span> _INPUT_',
                    lengthMenu: '{!!trans('base.show')!!}' + ': _MENU_',
                    paginate: { 'first': 'Trang đầu', 'last': 'Trang cuối', 'next': '&rarr;', 'previous': '&larr;' },
                    info: "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục"
            },
            drawCallback: function () {
            $(this).find('tbody tr').slice( - 3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
            $(this).find('tbody tr').slice( - 3).find('.dropdown, .btn-group').removeClass('dropup');
            }
    });
    
    $( ".datepicker" ).datepicker();
    // Basic datatable
    $('.datatable-basic').DataTable();
    $('.select').select2({
    minimumResultsForSearch: Infinity,
            containerCssClass: 'border-default'
    });
    
    $('#checkall').change(function() {
        $(this).removeClass('checked');
        $('.group').remove();
        if ($(this).is(":checked")) {
            $('.check').each(function() {
                $(this).prop("checked", true);
            });
        } else{  
            $('.check').each(function() {
                $(this).prop("checked", false);
            });   
        }
    });
    $(document).on('change', '.check', function () {
        var value  = $(this).val();
        if($(this).is(":checked")){
             $('.form-group').append('<input class="group" id='+value+' type="hidden" name="group[]" value="'+value+'">');
        }else{
            if ($('#checkall').is(":checked")) {
                $('#checkall').prop("checked", false);  
                $('#checkall').addClass('checked');
            }
            if($('#checkall').hasClass('checked')){
                $('.form-group').append('<input class="group" id='+value+' type="hidden" name="group[]" value="'+-value+'">');
            }else{
                $('.form-group').find('#'+value).remove();
            }
        }
        
    });
    $(document).on('click', '.paginate_button', function () {
        if ($('#checkall').is(":checked")) {
           $('.check').each(function() {
                $(this).prop("checked", true);
            }); 
        }
    });
    
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(element).select();
        document.execCommand("copy");
        $temp.remove();
    }

    
    
</script>

