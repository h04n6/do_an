{{-- lấy lựa chọn trong search --}}
    <script>
    $('.search-panel .dropdown-menu').find('a').click(function() {
        var param = $(this).attr("id");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });

    </script>

     {{-- Xem thông tin sp qua modal --}}
    <script >
        $(document).on('click', '.view-details-link', function () {
        var id_product = $(this).attr('id');
       $.ajax({
            url: '{{ asset('/api/view_product') }}',
            method: 'POST',
            data: {
                id_product: id_product
            },
            success: function (html) {
               if($('.position-modal-product').find('.view-product').length>0)
               {
                $('.position-modal-product').find('.view-product').remove('.view-product');
               }
               $('.position-modal-product').append(html);
                $('.view-product').modal('show');
                $('.modal-body').find('.group-img img').first().addClass('active');
                $('.modal-body').find('.group-size a').first().addClass('active');

                $('.tile')
            // tile mouse actions
            .on('mouseover', function(){
              $('.tile').children('.photo').css({'transform': 'scale('+ $('.tile').attr('data-scale') +')'});
            })
            .on('mouseout', function(){
              $('.tile').children('.photo').css({'transform': 'scale(1)'});
            })
            .on('mousemove', function(e){
              $('.tile').children('.photo').css({'transform-origin': ((e.pageX - $('.tile').offset().left) / $('.tile').width()) * 100 + '% ' + ((e.pageY - $('.tile').offset().top) / $('.tile').height()) * 100 +'%'});
            })
            // tiles set up
            .each(function(){
              $('.tile')
                // add a photo container
                .append('<div class="photo"></div>')
                // some text just to show zoom level on current item in this example

                // set up a background image for each tile based on data-image attribute
                .children('.photo').css({'background-image': 'url('+ $('.tile').attr('data-image') +')'});
            })

            }
        });
  

    });
    </script>

     <script >
        $(document).on('click', '.size', function () {
        var id_size = $(this).attr('id');
        $(this).closest('.group-size').find(".size").removeClass('active');
        $(this).addClass("active");
    });
    </script>
      <script >
        $(document).on('click', '.group-img img', function () {
        var id_color = $(this).attr('id');
        var id_product = $(this).closest('.tab-content').find('.id_product').attr('id');
        $(this).closest('.group-img').find("img").removeClass('active');
        $(this).addClass("active");
        var src =  $(this).attr("src");
        $(this).closest('.modal-body').find(".main-img .tile").attr('data-image',src);
        $(".photo").css({'background-image': 'url('+src+')'});
        $.ajax({
            url: '{{ asset('/api/get_list_img') }}',
            method: 'POST',
            data: {
                id_product: id_product,
                id_color: id_color
            },
            success: function (html) {
               
               $('.modal-body').find('.list-img').remove('.list-img');
               $('.modal-body').find('.list-add').append(html[0]);
               $('.modal-body').find('.group-size .size-cont').remove('.size-cont');
               $('.modal-body').find('.group-size').append(html[1]);
               $('.modal-body').find('.group-size a').first().addClass('active');
                
            }
        });


    });
    </script>
     <script >
        $(document).on('click', '.list-add .list-img img', function () {
            $(this).closest('.list-add').find("img").removeClass('active');
            $(this).addClass("active");
            var src =  $(this).attr("src");
            $(this).closest('.modal-body').find(".main-img .tile").attr('data-image',src);
        
            $(".photo").css({'background-image': 'url('+src+')'});

    });
    </script>

    {{-- Xu ly them vao gio hang --}}
     <script >
        $(document).on('click', '.btn-add-cart', function () {
            if ($(this).parent().find('a.disable').length>0) {
                return false;
            }
            var id_product = $(this).closest('.modal-body').find(".id_product").attr('id');
            var id_color = $(this).closest('.modal-body').find('.group-img img.active').attr('id');
            var id_size = $(this).closest('.modal-body').find('.group-size a.active').attr('id');
            var img = $(this).closest('.modal-body').find('.group-img img.active').attr('src');
            var qty =   $('input[name=qty]').val();
        $.ajax({
            url: '{{ asset('/api/ajaxAddToCart') }}',
            method: 'POST',
            data: {
                id_product: id_product,
                id_color: id_color,
                id_size: id_size,
                qty: qty,
                img:img
            },
            success: function (html) {

                 location.reload();
                

            }
        });


    });


    </script>
    <script > $('#goToCart').modal('show');</script>
{{-- Tăng giảm --}}
     <script >
        $(document).on('click', '.minus', function () {
            var qty=parseInt($(this).closest('.quantity').find('input[name=qty]').val());
            if (qty>1) {
                $(this).closest('.quantity').find('input[name=qty]').val(qty-1);
            }
            
        

    });
        $(document).on('click', '.plus', function () {
            var qty=parseInt($(this).closest('.quantity').find('input[name=qty]').val());

                 $(this).closest('.quantity').find('input[name=qty]').val(qty+1);

    });
    </script>


{{-- Them vao danh sach yeu thich --}}
     <script >
        $(document).on('click', '.wishlist', function () {
            var id_product = $(this).closest('.modal-body').find(".id_product").attr('id');
            var id_color = $(this).closest('.modal-body').find('.group-img img.active').attr('id');
            var id_size = $(this).closest('.modal-body').find('.group-size a.active').attr('id');
            var img = $(this).closest('.modal-body').find('.group-img img.active').attr('src');
        $.ajax({
            url: '{{ asset('/api/add-to-whish-list') }}',
            method: 'POST',
            data: {

                id_product: id_product,
                id_color: id_color,
                id_size: id_size,
                img:img
            },
            success: function (html) {
                if(html=="OK")
                {
                 $('#view-product').modal('hide');
                 swal("Đã thêm vào danh sách yêu thích!!", "", "success");
                }
                else if(html=="NotLogin")
                {
                     window.location = '{{ url("/login") }}'; 
                }
                

            }
        });


    });
    </script>
{{-- Đăng ký email --}}
     <script >
        $(document).on('click', '#register', function () {

            
            var email =   $('input[name=email_register]').val();
            if (email=="") {
                return false;
            }
        $.ajax({
            url: '{{ asset('/api/register_email') }}',
            method: 'POST',
            data: {
   
                email:email
            },
            success: function (html) {

               if(html=='sent')
               {
                swal("Đăng ký thành công", "Kiểm tra email để nhận thông tin sản sẩm của trang web nhé!!", "success");
               }
                

            }
        });


    });


    </script>
    {{-- get-Menu --}}
    <script >
        $(document).ready(function(){
            $.ajax({
            url: '{{ asset('/api/get_menu_male') }}',
            method: 'GET',
            data: {
            },
            success: function (html) {
                $('.category_male').append(html);
            }
        });
        });
    </script>
    <script >
        $(document).ready(function(){
            $.ajax({
            url: '{{ asset('/api/get_menu_female') }}',
            method: 'GET',
            data: {
            },
            success: function (html) {                
                $('.category_female').append(html);
            }
        });
        });
    </script>
  
    {{-- zoom h/a --}}
  <script>
    $('.tile')
    // tile mouse actions
    .on('mouseover', function(){
      $(this).children('.photo').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
    })
    .on('mouseout', function(){
      $(this).children('.photo').css({'transform': 'scale(1)'});
    })
    .on('mousemove', function(e){
      $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    })
    // tiles set up
    .each(function(){
      $('.tile')
        // add a photo container
        .append('<div class="photo"></div>')
        // some text just to show zoom level on current item in this example

        // set up a background image for each tile based on data-image attribute
        .children('.photo').css({'background-image': 'url('+ $(this).attr('data-image') +')'});
    })
    </script>