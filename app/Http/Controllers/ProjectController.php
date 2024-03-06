<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insert_Product; 
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function index(){
        $products= DB::table('products')->limit(4)->get();
        return view('index',['products'=>$products]);

    }
    public function about(Request $request){
        return view('about');
    }
    public function review(Request $request){
        return view('review');
    }
    public function products(){
        $products=DB::table('products')->paginate(8);//get data all in database
        return view('products',['products'=> $products]);
    }
    public function single_product(Request $request  , $id){
        $product_array=DB::table('products')->where('id',$id)->get();
        return view('single_product',['product_array'=>$product_array]);
    }

    public function create()
    {
        return view('insert_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $insert_product = new Insert_Product();
        $insert_product->name = $request->input('name');
        $insert_product->description = $request->input('description');
        $insert_product->price = $request->input('price');
        $insert_product->sale_price = $request->input('sale_price');
        $insert_product->quantity = $request->input('quantity');
        $insert_product->category = $request->input('category');
        $insert_product->type = $request->input('type');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('public', $filename);
            $insert_product->image = $filename;
            $insert_product->save();
            return redirect()->back()->with('status', 'Product Added Successfully');
        } else {
            return redirect()->back()->withErrors(['error' => 'Image not uploaded successfully.']);
        }
    }

}
