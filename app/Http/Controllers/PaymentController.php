<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;



class PaymentController extends Controller
{
public function    addorder(Request $request){

  $request->validate([
  
  "first_name"=>"required|string",
  "last_name"=>"required|string",
  "phone"=>"required|string",
  "email"=>"required|email",
  "address_1"=>"required|string",
  "country"=>"required|string",
  "city"=>"required|string",
  "pin_code"=>"required|string",
  "method"=>"required|string",
  
]);
  $address_2=$request->adderss_2==""?"":$request->adderss_2;
 $method=$request->method=="paypal"?"paypal":"cod"; 
//return  $method;
$user_id=Auth::user()->id;
$user=User::find($user_id);
$all_price=0;
foreach($user->carts as $item){
 $all_price+=$item->all_price;
}

 $order= Order::create([
"all_price"=>$all_price,
"user_id"=>Auth::user()->id,
"first_name"=>$request->first_name,
"last_name"=>$request->last_name,
"phone"=>$request->phone,
"email"=>$request->email,
"address_1"=>$request->address_1,
"address_2"=>$address_2,
"country"=>$request->country,
"city"=>$request->city,
"pin_code"=>$request->pin_code,
"method"=>$method

  ]);
$order_id= $order->id;
foreach($user->carts as $item){
  

  Orderitem::create(["user_id"=>Auth::user()->id
,"product_id"=>$item->product->id,
"order_id"=>$order_id,
"qty"=>$item->qty
]);
 }

 if($method=="cod"){
  Cart::where("user_id",Auth::user()->id)->delete();
  return redirect()->route("home");
 }else{

  return  $this->processPaypal($all_price,$order_id);
 }
}


public function processPaypal($all_price,$order_id)
{
   
    $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess'),
                "cancel_url" => route('processCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $all_price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {

                Session::put('order_id', $order_id);
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('home')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('home')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
}









public function processSuccess(Request $request)
{

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
          Order::where("id",session()->get("order_id"))->update([
            "status"=>"COMPLETED"
          ]);
          Cart::where("user_id",Auth::user()->id)->delete();
            return redirect()
                ->route('home')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('home')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

}



public function processCancel(Request $request)
    { Orderitem::where("order_id",session()->get("order_id"))->delete();
        Order::where("id",session()->get("order_id"))->delete();

        return redirect()
            ->route('home')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


}
