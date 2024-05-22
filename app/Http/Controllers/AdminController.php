<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Notifications\MyFirstNotification;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    
    public function view_category()
    {
        $data=Category::all();
        return view('admin.category',compact('data'));
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
    public function add_category(Request $request)
    {
        Category::create([
            'category_name' => $request->category_name
        ]);
        return redirect()->back()->with('massage','category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $data=Category::find($id);
       $data->delete();
        return redirect()->back()->with('delete','category deleted successfully');
    }

    public function order(){
        $order=Order::all();
        return view('admin.order',compact('order'));
    }

    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return redirect()->back();

    }

    public function print_pdf($id){
        $order=Order::find($id);
        $PDF=PDF::loadview('admin.pdf',compact('order'));
        return $PDF->download('order_details.pdf');
    }

    public function send_email($id){
        $order=Order::find($id);
        return view('admin.send_email', compact('order'));
    }

    public function send_user_email(Request $request ,$id){
        $order=Order::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,

        ];
          Notification::send($order,new MyFirstNotification($details));
          return redirect()->back();
    }
    


    public function search(Request $request){

        $search=$request->search;

        $order=Order::where('name','LIKE',"%$search%")->orwhere('phone','LIKE',"%$search%")->orwhere('product_title','LIKE',"%$search%")->get();

        return view('admin.order',compact('order'));
    }


    public function show_order(){

        if(auth()->id()){
            // $user=Auth::user();
            // $user_id=$user->id;
            // $order=Order::where('user_id',$user_id)->get();
            $order=Order::all();

            return view('home.order',compact('order'));
        }
        else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        $order=Order::find($id);
        $order->delivery_status='your order has been cancelled';
        $order->save();
        return redirect()->back();
    }
}
