<div class="position-modal-product">
  
</div>

@if (Session::has('addCart'))
<div class="modal fade right modal-scrolling show" id="goToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false" >
      <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content" style="width: 95%;">
          <!--Header-->
          <div class="modal-header">
            <p class="heading">Đã thêm sản phẩm vào giỏ hàng
            </p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">×</span>
            </button>
          </div>

          <!--Body-->
          <div class="modal-body">

            <div class="row">
              <div class="col-3">
                <p></p>
                <p class="text-center">
                  <i class="fa fa-gift fa-4x"></i>
                </p>
              </div>
              <a href="{{ route('cart') }}" class="btn btn-danger waves-effect waves-light">Tới giỏ hàng
              <i class="fa fa-diamond ml-1 white-text"></i>
            </a>
            <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Tiếp tục mua sắm</a>
          </div>
              
            </div>
          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            
        </div>
        <!--/.Content-->
      </div>
    </div>
@endif