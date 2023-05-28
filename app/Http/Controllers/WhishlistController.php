<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\User;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
   public function index($id){
$user_id=Auth::user()->id;

$user=User::find($user_id);
$is_exists_in_whishlist=Whishlist::where("user_id",$user_id)->where("product_id",$id)->exists();
$is_exists_in_cart=Cart::where("user_id",$user_id)->where("product_id",$id)->exists();

if($is_exists_in_whishlist || $is_exists_in_cart){
    return back()->With("msg","it is in whishlist oR in cart");
}else{

    Whishlist::create(["user_id"=>$user_id,"product_id"=>$id]);
    return back()->With("msg","added TO whishlist");
}

   }



   public function showwhishlist(){
if(Auth::check()){

    $user_id=Auth::user()->id;

    $user=User::find($user_id);
     

 return view("whishlist",compact("user"));
}

   }

   public function remove($id){
    if(Auth::check()){
        $is_exists_in_whishlist=Whishlist::where("user_id",Auth::user()->id)->where("product_id",$id)->exists();
if($is_exists_in_whishlist){
    Whishlist::where("user_id",Auth::user()->id)->where("product_id",$id)->delete();
return back()->with("msg","deleted");
}

    }

   }
}
