@extends('admin_layout')
@section('admin_content')
<div class="row" style="height: 100vh">
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
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa phiếu nhập kho
                        </header>
                        <form class="col-12" action="{{URL::to('admin/updating-GRN')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form">
                                @foreach($info as $value)
                                <div class="form-group">
                                    <label>Mã phiếu:</label>
                                    <input name="id_old" type="hidden" value="{{$value->id}}">
                                    <input id="id" class="form-control" placeholder="id" name="id" value="{{$value->id}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Tên sản phẩm:</label></br>
                                    <input name="product_id" type="hidden" value="{{$value->product_id}}">
                                    <input name="name" class="form-control" placeholder="Note code" value="{{$value->product}}" readonly>
                                </div>
                                

                                <div class="form-group">
                                    <label>Số lượng:</label>
                                    <input name="quantity_old" type="hidden" value="{{$value->quantity}}">
                                    <input name="quantity" class="form-control" placeholder="Product quantity" value="{{$value->quantity}}">
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-info">Lưu</button>
                            </form>
                            </div>
                        </div>
                        </form>
                    </section>

            </div>

@endsection