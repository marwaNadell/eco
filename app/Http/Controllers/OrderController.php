<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

if(Auth::check()){
$user_id= Auth::user()->id;
$order_items=Order::where("user_id",$user_id)->get();


return view("orders",compact("order_items"));

}else{

    return back();
}
    }


    public function ordersdetail($id=null){

        if(Auth::check()){
            $user_id= Auth::user()->id;
            $order_items=Orderitem::where("user_id",$user_id)->where("order_id",$id)->get();
            
            
            return view("orderdetails",compact("order_items"));
            
            }else{
            
                return back();
            }

    }
}
