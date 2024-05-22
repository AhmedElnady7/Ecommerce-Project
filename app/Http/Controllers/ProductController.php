<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view_product()
    {
        $category=Category::all();
        return view('admin.product',compact('category'));
    }


    public function product_details($id){
        $products=Product::find($id);
        return view('admin.product_details',compact('products'));
    }
    public function add_to_cart( Request $request,$id){
        if(Auth::id())
        {
            $user=Auth::user();
            $product=Product::find($id);
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->email=$user->email;
            $cart->address=$user->address;
            $cart->product_title=$product->title;
            if($product->discount_price!==null){

                $cart->price=$product->discount_price * $request->quantity;
            }
            else{

                $cart->price=$product->price * $request->quantity;
            }
            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->user_id=$user->id;
            $cart->save();
            return redirect()->back();

        }
        else{
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add_product(Request $request)
    {
      $product = new Product();
      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->discount_price = $request->discount_price;
      $product->quantity = $request->quantity;
      $product->category = $request->category;

      $image = $request->image;
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('product', $imagename);
      $product->image = $imagename;
      $product->save();

        return redirect()->back()->with('success','product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show_product(Product $product)
    {
        $products=Product::all();
        return view('admin.show_product', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

  
    public function update_product($id)
    {
        $products=Product::find($id); 
        $category=Category::all();  
        return view('admin.update_product', compact('products','category'));
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product,$id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        $image = $request->image;
        if($image){
    
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;
        }
        $product->save();

        return redirect('/show_product')->with('success','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('delete','product deleted successfully');
    }


}
