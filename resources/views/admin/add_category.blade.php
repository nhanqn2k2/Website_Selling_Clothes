@extends('admin_layout')
@section('admin_content')
<div class="row" style="height: 90vh">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label>Tên danh mục:</label>
                                    <input name="category_name" class="form-control" placeholder="Category product name">
                                </div>
                                <div class="form-group">
                                    <label>Slug:</label>
                                    <input name="category_slug" class="form-control" placeholder="Category product code">
                                </div>
                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>

@endsection