<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(){
        $products=Product::paginate(3);
        return view('home.userbage',compact('products'));
       }


    public function redirect(){

        $usertype=Auth::user()->usertype;

        if($usertype==1){
            $total_products=Product::all()->count();
            $total_orders=Order::all()->count();
            $total_customers=User::all()->count();
            $orders=Order::all();
            $total_revenue=0;
            foreach($orders as $order){
                $total_revenue=$total_revenue+$order->price;
            }

            $order_delivered=Order::where('delivery_status','delivered')->get()->count();
            
            $order_processing=Order::where('delivery_status','processing')->get()->count();

            
            return view('admin.home', compact('total_products','total_orders','total_customers','total_revenue','order_delivered','order_processing'));
        }

        else
        {
            $products=Product::paginate(3);
            return view('home.userbage',compact('products'));
        }
    }

   
   
}
