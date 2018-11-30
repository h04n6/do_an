
@extends('backend.layouts.master')
@section('content')
<!-- Dashboard content -->
<div class="row">

    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{trans('base.data_customer')}}</span></h4>
                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{!!route('admin.index')!!}"><i class="icon-home2 position-left"></i>{{trans('base.system')}}</a></li>
                <li><a href="{!!route('admin.customer.index')!!}">Quản lý nhân viên</a></li>

            </ul>
        </div>
    </div>
    <div class="content">
        <div class="panel panel-flat">          
        </div>
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Danh sách nhân viên</h5>
                  
                           
            <div class="heading-elements" style="width: 450px;">
                    <div class="form-group col-md-5">
                <form class="form-show" action="{{ route('admin.staff.index') }}" method="GET">
              <div class=" ">
              <select name="type" id="load" class="form-control select2">
                @if ($type==0)
                   <option value="0" class="text-center" {{"selected= 'selected'"}}>===Tất cả===</option>
                   @else <option value="0" class="text-center" >===Tất cả===</option>
                @endif
                
                  @foreach($staff_type as $value)
                  @if ($type==$value->id)
                  <option value="{{ $value->id }}" {{"selected= 'selected'"}}>{!!$value->name!!}</option>
                  @else <option value="{{$value->id}}" >{{$value->name}}</option>
                  @endif
                  @endforeach
              </select>
            </div>
            </form>

            </div>
            <div class="heading-btn-group">
             
            <a id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple"><i class="icon-database-export text-primary"></i><span>Xuất danh sách</span></a>
            <a href="{{ route('admin.products.create')}}" id="button-export" class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class="icon-plus-circle2 text-primary"></i><span>Tạo mới</span>
            </a>
             <a id="button-delete" class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class="icon-trash icon_delete"></i><span>Xóa</span>
            </a>
            </div>
            </div>
            </div>    

            <table class="table datatable-basic">
                <thead>
                    <tr>
                      
                        <th style="width: 100px;">
                            <form action="{{route('admin.staff.export')}}" method="POST" class="form-group">  
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="styled" id="checkall" type="checkbox" name="group[]" value="0"/>
                            </form>
                        </th>
                        <th style="width: 120px;">Mã nhân viên</th>
                        <th>Tên nhân viên</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>{{trans('base.control')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($staffs as $key=>$staff)
                    <tr>
                        
                        <td><input class="check styled" type="checkbox" name="group[]" value="{{$staff->id}}"/></th>
                        <td>{{$staff->id}}</td>
                        <td><a href="">{{$staff->name}}</a></td>
                        <td>{{$staff->address}}</td>
                        <td>{{$staff->phone}}</td>
                        <td class="text-center">
                            <form action="{!! route('admin.staff.destroy', $staff->id) !!}" method="POST" style="display: inline-block">
                                   <a  href="{{ route('admin.store.edit', $staff->id) }}" title="Chỉnh sửa" class="text-success">
                                <i class="icon-pencil"></i>
                            </a>
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a title="{!! trans('base.delete') !!}" class="delete text-danger">
                                    <i class="icon-close2"></i>
                                </a>              
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /basic datatable -->
    </div>
</div>
@stop

@section('script')
@parent
<script>
     $('.select2').select2({});
    $('#load').change(function () {
        $('.form-show').submit();
    });
</script>
@stop