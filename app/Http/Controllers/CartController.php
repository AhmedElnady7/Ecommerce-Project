<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class CartController extends Controller
{
    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;
        $cart=Cart::where('user_id',$id)->get();

        return view('home.show_cart',compact('cart'));

        }
        else{
            return redirect('login');
        }
        
    }

    public function remove_product($id){
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }



    public function cash_order(){
        $user=Auth::user();
        $user_id=$user->id;
        $data=Cart::where('user_id',$user_id)->get();
        foreach($data as $data){
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;
            $order->price=$data->price;
            $order->product_title=$data->product_title;
            $order->product_id=$data->product_id;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='cash on delevery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('massage','we have recived your order.we will contact you soon...');
    }


    public function stripe($totalprice){
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request ,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment." 
        ]);


        $user=Auth::user();
        $user_id=$user->id;
        $data=Cart::where('user_id',$user_id)->get();
        foreach($data as $data){
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;
            $order->price=$data->price;
            $order->product_title=$data->product_title;
            $order->product_id=$data->product_id;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='Paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
      
        
        return redirect()->back()->with('success','Payment successful!');
              
        
    }

}
