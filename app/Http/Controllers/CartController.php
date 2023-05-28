<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function getall(){

    if(Auth::check()){

        $cart = Cart::where("user_id",Auth::user()->id)->get();
        return view("cart",compact("cart"));
    }
    return back();
   }
    
    public function addtocart(Request $request){
 

        if(Auth::check()){
            $data=$request->validate(["qty"=>"required|numeric","product_id"=>"required|numeric"]);
                    $qty=0;
                    $all_price=0;
                    $price=0;
            $in_cart=    Cart::where("product_id",$request->product_id)->where("user_id",auth()->user()->id)->exists();
                    if($in_cart){
                        return back()->with("msg","it is in cart ....");
                    }
            $product=Product::find($request->product_id)->exists();
           if($product){
            $product=Product::find($request->product_id);
              if($request->qty >=$product->qty){
                $qty =  $product->qty; 
                
              }else{
                $qty=$request->qty;
              }
            if($product->sale==0){
                $all_price=$qty* $product->price;
                $price=$product->price;
            }else{
                $all_price=$qty* $product->sale;
                $price=$product->sale;
            }
        Product::where("id",$product->id)->update(["qty"=>$product->qty-$qty])  ;  
 Cart::create(["user_id"=>auth()->user()->id,"qty"=>$qty,"product_id"=>$product->id,
 "all_price"=>$all_price,"price"=>$price

]);
$is_in_whishlist= Whishlist::where("user_id",auth()->user()->id)->where("product_id",$request->product_id)->exists();
if($is_in_whishlist){
  Whishlist::where("user_id",auth()->user()->id)->where("product_id",$request->product_id)->delete();
  return back()->with("msg","added to cart");
}
return redirect()->route("home");
           }else{
            return back()->with("msg","no product ....");
           }
         
         
         
         
         
         
         
         
            //  return [auth()->user()->id,$request->qty,$request->product_id];
        }
        
        return back()->with("msg","please log in ....");

    }

    public function cartremove($id=null){

       $is_exists= Cart::where("user_id",auth()->user()->id)->where("product_id",$id)->exists();
       if($is_exists){

       $item= Cart::where("user_id",auth()->user()->id)->where("product_id",$id)->get();
      $cart_qty= $item[0]->qty;

     $product_qty= Product::where("id",$id)->get()[0]->qty;
     Product::where("id",$id)->update(["qty"=>$cart_qty+$product_qty]);
     Cart::where("user_id",auth()->user()->id)->where("product_id",$id)->delete();

     return back();
    }
    }

    public function cartedit(Request $request){

        if(!is_numeric($request->qty)){
            return response()->json(["res"=>"done"]);
        }
         $pro_id=  $request->id;

         $qty=abs($request->qty);

         if($qty<0){
            $qty=0;
         }
         $user_id= Auth::user()->id;
         
         $is_exists= Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->exists();
         if($is_exists){

            $item= Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->get();
            $cart_qty= $item[0]->qty;
            $cart_price=$item[0]->price;
            $product_qty= Product::where("id",$pro_id)->get()[0]->qty;
          
            if($cart_qty>$qty){
               $new_cart_qty=$cart_qty-$qty;
               Product::where("id",$pro_id)->update(["qty"=> $new_cart_qty+$product_qty]);
               Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->update([
"qty"=>$qty,
"all_price"=>$qty * $cart_price
               ]);
               return response()->json(["res"=>"done"]);
            }else if($qty==0){
if( $cart_qty==0){
    return response()->json(["res"=>"done"]);
}else{
    $new_cart_qty=$cart_qty-$qty;
    Product::where("id",$pro_id)->update(["qty"=> $new_cart_qty+$product_qty]);
    Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->update([
        "qty"=>$qty,
        "all_price"=>$qty * $cart_price
                       ]);
}

            }else if($cart_qty<$qty){
              $a =  $qty-$cart_qty;
              if( $product_qty>=$a){
                Product::where("id",$pro_id)->update(["qty"=> $product_qty-$a]);
                Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->update([
                    "qty"=>$a+$cart_qty,
                    "all_price"=>($a+$cart_qty) * $cart_price
                                   ]);
                                   return response()->json(["res"=>"done"]);                
              }else{
                Cart::where("user_id",auth()->user()->id)->where("product_id",$pro_id)->update([
                    "qty"=>$product_qty+$cart_qty,
                    "all_price"=>($product_qty+$cart_qty) * $cart_price
                                   ]);
                                   Product::where("id",$pro_id)->update(["qty"=> 0]);
              }

            }
            
         }









       // return response()->json(["res"=>[$pro_id,$qty,$user_id]],200);
    }

    public function carttotal(){
      //  return response()->json(["total"=>100]);
        $user_id=Auth::user()->id;
        $all_price=0;
        $all_price_for_one_product=Cart::where("user_id",$user_id)->get();

        foreach($all_price_for_one_product as $item){

            $all_price+=$item->all_price;

        }

return response()->json(["total"=>$all_price]);
    }
}
