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
                Thêm phiếu nhập kho
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('admin/adding-GRN')}}" method="POST">
                                {{ csrf_field() }}
                            
                                <div class="form-group">
                                    <label>Nhập mã sản phẩm:</label></br>
                                    <input name="id" id="id" class="form-control" placeholder="Mã sản phẩm">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Số lượng nhập:</label>
                                    <input name="quantity" id="quantity" class="form-control" placeholder="Số lượng nhập">
                                </div>                                
                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection