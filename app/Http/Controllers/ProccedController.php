<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProccedController extends Controller
{
   public function showprocced(){

$empty_cart= Cart::where("user_id",Auth::user()->id)->exists();

if(! $empty_cart){

    return redirect()->route("home");
}
$cart= Cart::where("user_id",Auth::user()->id)->get();
$total_price=0;
foreach($cart as $item){
    $total_price+=$item->all_price;

}
    return view("procced",compact("cart","total_price"));
   }
}
