<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;
use App\Models\cart;
use App\Models\product_category;
use Illuminate\Support\Facades\Redirect;


class HomeController extends Controller
{
    public function index() {
        $ao = product::where('category_id','29')->get();
        $phukien = product::where('category_id','32')->get();
        $danhmuc = product_category::all();
        return view('frontend.index',compact('ao','phukien','danhmuc'));
    }

    public function products($id) {
        $product = product::where('id',$id)->get();
        $danhmuc = product_category::all();
        return view('frontend.product',compact('product','danhmuc'));
    }

    #Các danh mục sản phẩm
    public function danhmuc($slug,$id) {
        $product = product_category::find($id)->sanpham;
        $danhmuc = product_category::all();
        return view('frontend.danhmuc',compact('product','danhmuc'));
    }

    #Giỏ hàng
    public function savecart(Request $request) {
        $id = $request->id_hidden;
        $quantity = $request->qty;

        $info = product::where('id',$id)->first();
        


        $conn = mysqli_connect("localhost","root","","esdc");
        $tmp = cart::all();
        foreach ($tmp as $t) {
            if ($t->thumbnail == $info->thumbnail) {
                $q = $t->quantity + $quantity;
                $sql = "UPDATE cart SET quantity = $q WHERE thumbnail = '$info->thumbnail'";
                $conn -> query ($sql);
                $conn -> close();
                $done = true;
            }
        }
        
        if (!isset($done)) { 
            //$sql = "delete from cart";
            $sql = "INSERT INTO cart (id,name,price,quantity,thumbnail)
            VALUES ('$id','$info->name', '$info->price','$quantity','$info->thumbnail')";
            $conn -> query ($sql);
            $conn -> close();
        }
        
        return Redirect::to('/shopping-cart');
    }

    public function update_cart(Request $request) {
        $quantity = $_POST['qty'];
        $id = $request->id_hidden;    

        $conn = mysqli_connect("localhost","root","","esdc");
        
        $sql = "UPDATE cart SET quantity = $quantity WHERE id = '$id'";
        $conn -> query ($sql);
        $conn -> close();
        return Redirect::to('/shopping-cart');
    }

    public function delete_cart(Request $request) {
        $id = $request->id_hidden;


        $conn = mysqli_connect("localhost","root","","esdc");
        $sql = "DELETE FROM cart WHERE id = $id";
        $conn -> query ($sql);
        $conn -> close();
        return Redirect::to('/shopping-cart');
    }



    public function shoppingcart() {
        $cart = cart::all();
        $danhmuc = product_category::all();
        return view('frontend.shopping-cart',compact('cart','danhmuc'));
    }

    
}
