<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_category;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function add_category()
    {
        return view('admin.add_category');
    }

    public function all_category()
    {
        $product_category_list = product_category::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.all_category', compact('product_category_list'));
    }

    public function add_category_post(Request $request)
    {
        $product_category = new product_category;

        $product_category->name = $request->input('category_name');
        $product_category->slug = $request->input('category_slug');
        $product_category->status = 1;
        $product_category->save();

        return redirect()->route('admin.all_category')->with('success', 'Thêm mới danh mục sản phẩm thành công!');
    }

    public function update_category(Request $request, $id)
    {
        $product_category = product_category::where('id', $id)->get()->toArray()[0];
        return view('admin.update_category', compact('product_category'));
    }

    public function update_category_post(Request $request, $id)
    {
        $product_category = product_category::find($id);
        $product_category->name = $request->input('category_name');
        $product_category->slug = $request->input('category_slug');
        $product_category->status = 1;
        $product_category->save();

        // return view('admin.update_category', compact('product_category'))->with('success', 'Chỉnh sửa danh mục sản phẩm thành công!');
        return Redirect::to('admin/all-category')->with('success', 'Chỉnh sửa danh mục sản phẩm thành công!');
    }

    public function delete_category($id)
    {
        $product_category = product_category::find($id);

        if ($product_category) {
            product_category::destroy($id);
        }

        return back()->with('success', 'Xóa danh mục sản phẩm thành công!');
    }
}
