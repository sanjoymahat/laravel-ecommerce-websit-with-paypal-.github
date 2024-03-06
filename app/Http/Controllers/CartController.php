<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){
        return view('cart');
    }
    
    public function add_to_cart(Request $request){
        //if we have a cart in session
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart'); //its provide associative array ['id'=>'image '];
            $products_array_ids = array_column($cart, 'id'); //return array of number product_id
            $id = $request->input('id');
            //here add product in cart
            if(!in_array($id, $products_array_ids)){
                $name = $request->input('name');
                $image = $request->input('image');
                $price = $request->input('price'); //original price of product
                $quantity = $request->input('quantity');
                $sale_price = $request->input('sale_price'); //sale price of product
                
                $price_to_charge = $sale_price != null ? $sale_price : $price;
                
                $product_array = array(
                    'id' => $id,
                    'name' => $name,
                    'image' => $image,
                    'quantity' => $quantity,
                    'price' => $price_to_charge
                );
                $cart[$id] = $product_array;
                $request->session()->put('cart', $cart);
                //here product already in cart
            } else {
                echo "<script>alert('Product is already in cart')</script>";
            }
            $this->calculateTotalcart($request);
            return view('cart');
        } else {
            $cart = array();
            $id = $request->input('id');
            $name = $request->input('name');
            $image = $request->input('image');
            $price = $request->input('price'); //original price of product
            $quantity = $request->input('quantity');
            $sale_price = $request->input('sale_price'); //sale price of product
            
            $price_to_charge = $sale_price != null ? $sale_price : $price;
            
            $product_array = array(
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'quantity' => $quantity,
                'price' => $price_to_charge
            );
            $cart[$id] = $product_array;
            $request->session()->put('cart', $cart);
            $this->calculateTotalcart($request);
            return view('cart');
        }  
    }
    //this function is use total product price and total quantity but here inicial phase both are 0
    public function calculateTotalcart(Request $request){
        $cart=$request->session()->get('cart');
        $total_price=0;
        $total_quantity=0;
        foreach($cart as $id=>$product){
            $product=$cart[$id];
            $price=$product['price'];
            $quantity=$product['quantity'];
            $total_price=$total_price+($price*$quantity);
            $total_quantity=$total_quantity+$quantity;
        }
        $request->session()->put('total',$total_price);
        $request->session()->put('quantity',$total_quantity);
    }
    function remove_form_cart(Request $request){
        //this functiion is use remove or delete cart or form
        if($request->session()->has('cart')){
            $id=$request->input('id');
           $cart=$request->session()->get('cart');//array
           unset($cart[$id]);
           $request->session()->put('cart',$cart);
           $this->calculateTotalcart($request);
        }
        return view('cart');
    }
    function checkout(){
        return view('checkout');
    }




    function place_order(Request $request){
        if($request->session()->has('cart')){
            $name=$request->input('name');
            $email=$request->input('email');
            $phone=$request->input('phone');
            $city=$request->input('city');
            $address=$request->input('address');
            $cost=$request->session()->get('total');
            $status="Not Paid";
            $date=date('Y-m-d h:i:s');
            $cart=$request->session()->get('cart');
            $oder_id = DB::table('oders')->insertGetId([
                'cost'=>$cost,
                'name'=>$name,
                'email'=>$email,
                'status'=>$status,
                'city'=>$city,
                'address'=>$address,
                'phone'=>$phone,
                'date'=>$date
            ],'id');
            foreach($cart as $id=>$product){
            $product=$cart[$id];
            $product_id=$product['id'];
            $product_name=$product['name'];
            $product_price=$product['price'];
            $product_quantity=$product['quantity'];
            $product_image=$product['image'];
            DB::table('oder_items')->insert([
                'order_id'=>$oder_id,
                'product_id'=>$product_id,
                'product_name'=>$product_name,
                'product_price'=>$product_price,
                'product_quantity'=>$product_quantity,
                'product_image'=>$product_image,
                'order_date'=>$date

            ]);
            }
            $request->session()->put('order_id',$oder_id);
            return view('payment');
        }else{
            return redirect('/');
        }
    }
}
