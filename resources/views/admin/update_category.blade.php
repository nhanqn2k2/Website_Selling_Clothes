@extends('admin_layout')
@section('admin_content')
<div class="row" style="height: 90vh">
    <div class="col-lg-12">
        <section class="panel">
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
            <header class="panel-heading">
            Chỉnh sửa danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form method="POST" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label>Tên danh mục:</label>
                                        <input value="{{$product_category['name']}}" name="category_name" class="form-control" placeholder="Category product name">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug:</label>
                                        <input value="{{$product_category['slug']}}" name="category_slug" class="form-control" placeholder="Category product code">
                                    </div>
                                    <button type="submit" class="btn btn-info">Chỉnh sửa</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>

@endsection