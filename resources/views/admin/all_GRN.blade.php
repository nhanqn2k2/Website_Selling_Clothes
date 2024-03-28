@extends('admin_layout')
@section('admin_content')


<div class="table-agile-info" style="height: 110vh">

@if (session('error'))
    		<div  class="alert alert-danger" role="alert">
        	    {{ session('error') }}
    		</div>
	@endif
	@if (session('success'))
		<div style="font-size: 16px" class="alert alert-success text-center" role="alert">
			{{ session('success') }}
		</div>
	@endif
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả phiếu nhập kho
    </div>
    <br>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:30px;"></th>
            <th style="color: black;">Mã phiếu</th>
            <th style="color: black;">Ngày nhập</th>
            <th style="color: black;">Sản phẩm</th>
            <th style="color: black;">Số lượng</th>
            <th style="color: black;">Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($GRN as $tmp => $value)
          <tr>
            <td><label class="i-checks m-b-none"></label></td>
            <td style="color: black;">{{$value['id']}}</td>
            <td style="color: black;">{{$value['date']}}</td>
            <td style="color: black;">{{$value['product']}}</td>
            <td style="color: black;">{{$value['quantity']}}</td>
            <td style="color: black;">{{number_format($value['total']).' đ'}}</td>
            <td style="width: 120px">
              <a href="{{URL::to('admin/update-GRN/'.$value['id'])}}" class="btn-info btn btn-sm">Sửa</a>
              <a href="#" data-id="{{$value['id']}}" class="btn-danger btn btn-sm delete-product-btn" data-toggle="modal" data-target="#delete-product-modal">Xóa</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>


<div class="modal" id="delete-product-modal">
              <div class="modal-dialog">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Xóa phiếu nhập kho</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  Bạn có chắc chắn muốn xóa phiếu nhập kho này?
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">        
                <a href="{{URL::to('admin/remove-GRN',['id'=>0])}}" class="btn btn-primary btn-modal-delete-product">Đồng ý</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
                </div>
              </div>
            </div>

@endsection