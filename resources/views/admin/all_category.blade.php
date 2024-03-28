@extends('admin_layout')
@section('admin_content')

<div style="font-size: 16px; height: 110vh" class="table-agile-info text-center">
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
    	Tất cả danh mục sản phẩm
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="color: black;">STT</th>
            <th style="color: black;">Tên danh mục</th>
            <th style="color: black;">Slug</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
		@foreach ($product_category_list as $key => $product_category_item)
			<tr>
        <td style="color: black;">{{$key+1}}</td>
				<td style="color: black;">{{$product_category_item['name']}}</td>
				<td style="color: black;">{{$product_category_item['slug']}}</td>
				<td style="width: 170px">
          <a href="update-category/{{$product_category_item['id']}}" class="btn-info btn btn-sm">Chỉnh sửa</a>
          <a href="#" data-id="{{$product_category_item['id']}}" class="btn-danger btn btn-sm delete-product-btn" data-toggle="modal" data-target="#delete-product-modal">Xóa</a>
          </a>
				</td>
			  </tr>
      	@endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
		{{ $product_category_list->links() }}
    </footer>
  </div>
</div>

<div class="modal" id="delete-product-modal">
  <div class="modal-dialog">
    <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">Xóa danh mục sản phẩm</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body">
      Bạn có chắc chắn muốn xóa danh mục sản phẩm này?
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">        
      <a href="{{route('admin.delete_category',['id' => 0])}}" class="btn btn-primary btn-modal-delete-product">Đồng ý</a>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
    </div>
    </div>
  </div>
</div>
@endsection