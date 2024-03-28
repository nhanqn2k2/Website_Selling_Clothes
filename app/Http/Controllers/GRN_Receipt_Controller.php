<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;
use App\Models\cart;
use App\Models\order_product;
use App\Models\GRN;
use App\Models\order_detail;
use App\Models\product_category;
use Illuminate\Support\Facades\Redirect;

class GRN_Receipt_Controller extends Controller
{
    public function add_GRN(){
        $product = product::all();
        return view('admin.add_GRN',compact('product'));
    }

    public function adding_GRN(Request $request){
        $product_id = $_POST['id'];
        $quantity = $_POST['quantity'];
        

        $t = product::where('id',$product_id)->first();

        $conn = mysqli_connect("localhost","root","","esdc");

        $total = $t->price*$quantity;

        $q = $t->quantity + $quantity;
        $sql = "UPDATE product SET quantity = $q WHERE id = '$t->id'";
        $conn -> query ($sql);
        $sql_GRN = "INSERT INTO GRN (product_id,product,quantity,total)
        VALUES ('$t->id','$t->name', '$quantity','$total')";
        $conn -> query ($sql_GRN);
        $conn -> close();
     
        return Redirect::to('admin/all-GRN')->with('success', 'Lập phiếu nhập hàng thành công');
        
    }

    public function update_GRN($id){
        $info = GRN::where('id',$id)->get();
        return view('admin.update_GRN',compact('info'));
    }

    public function updating_GRN(Request $request){
        $id_old = $request->id_old;
        $id = $request->id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $quantity_old = $request->quantity_old;

        $t = product::where('id',$product_id)->first();
        $new_quantity = $t->quantity - $quantity_old + $quantity;

        $total = $t->price*$quantity;
        $conn = mysqli_connect("localhost","root","","esdc");

        $sql_p = "UPDATE product SET quantity='$new_quantity' WHERE id = $product_id";
        $conn -> query ($sql_p);

        $sql = "UPDATE GRN SET id=$id, quantity='$quantity', total='$total' WHERE id = $id_old";
        $conn -> query ($sql);
        $conn -> close();
     
        return Redirect::to('admin/all-GRN')->with('success', 'Chỉnh sửa phiếu nhập kho thành công!');
    }

    public function all_GRN(){
        $GRN = GRN::orderBy('date', 'desc')->get();;
        return view('admin.all_GRN',compact('GRN'));
    }

    public function remove_GRN($id){
        $grn = GRN::where('id',$id)->first();
        $t = product::where('id',$grn->product_id)->first();
        $new_quantity = $t->quantity - $grn->quantity;

        $conn = mysqli_connect("localhost","root","","esdc");

        $sql_p = "UPDATE product SET quantity='$new_quantity' WHERE id = '$grn->product_id'";
        $conn -> query ($sql_p);

        $sql = "DELETE FROM GRN WHERE id = $id";
        $conn -> query ($sql);
        $conn -> close();

        return back()->with('success', 'Xóa phiếu nhập kho thành công!');
    }

    public function all_receipt(){
        $donhang = order_product::orderBy('date', 'desc')->get();;
        return view('admin.all_receipt',compact('donhang'));
    }

    public function update_receipt($id){
        $info = order_product::where('id',$id)->get();
        $detail = order_detail::where('order_id',$id)->get();
        return view('admin.update_receipt',compact('info','detail'));
    }

    public function view_receipt($id){
        $info = order_product::where('id',$id)->get();
        $detail = order_detail::where('order_id',$id)->get();
        return view('admin.view_receipt',compact('info','detail'));
    }


    public function updating_receipt(Request $request){
        $id_old = $request->id_old;
        $name = $request->customer_name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $date = $request->date;
        $pay = $request->pay;

        $conn = mysqli_connect("localhost","root","","esdc");
        $sql = "UPDATE order_product SET customer_name='$name', email='$email', phone='$phone', billing_address='$address', pay='$pay', date='$date' WHERE id = $id_old";
        
        $conn -> query ($sql);
        $conn -> close();
     
        return Redirect::to('admin/all-receipt')->with('success', 'Chỉnh sửa đơn hàng thành công!');
    }

    public function remove_receipt($id){
        $conn = mysqli_connect("localhost","root","","esdc");
        $sql = "DELETE FROM order_product WHERE id = $id";
        $conn -> query ($sql);
        $conn -> close();

        return back()->with('success', 'Xóa đơn hàng thành công!');
    }
    

    #Thanh toán

    #Giỏ hàng
    public function order() {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $billing_address = $_POST['address'];
        $paymentMethod = $_POST['paymentMethod'];

        $conn = mysqli_connect("localhost","root","","esdc");
        $tmp = cart::all();
        $product_list = "";
        $sum = 0;
        foreach ($tmp as $t) {
            global $sum, $product_list;
            $product_list = $product_list . $t->name . " (SL: " . $t->quantity . "). ";
            $sum = $sum + $t->price*$t->quantity;
        }

        
        
        //$sql = "delete from donhang";
        $sql = "INSERT INTO order_product (customer_name,email,phone,total,billing_address,pay)
        VALUES ('$name','$email','$phone','$sum','$billing_address','$paymentMethod')";
        $conn -> query ($sql);

        $order = order_product::all()->last();

        $cart = cart::all();

        foreach ($cart as $t) {
            $k = $t->price*$t->quantity;
            $sql_detail = "INSERT INTO order_detail (order_id,product_id,product_name,quantity,total)
            VALUES ('$order->id','$t->id','$t->name','$t->quantity','$k')";
            $conn -> query ($sql_detail);

            $sql_update_qty = "UPDATE product SET quantity=quantity-$t->quantity WHERE id = $t->id";
            $conn -> query ($sql_update_qty);
        }

        $sql = "delete from cart";
        $conn -> query ($sql);
        $conn -> close();
        
        return Redirect::to('/index.html');
    }

    public function checkout() {
        $cart = cart::all();
        $danhmuc = product_category::all();
        
        return view('frontend.check-out',compact('cart','danhmuc'));
    }
}
