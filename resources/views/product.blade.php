@extends("layout")
@section("title","product")
@section("content")

<div class="bg-warning"><h3>{{$product->category->slug}}/{{$product->slug}}</h3></div>
<h2 class="text-center text-danger">
    @if(session()->has("msg"))
    {{session()->get("msg")}}
    @endif
</h2>
<form action={{route("addtocart")}} method="post">
@csrf
<input type="hidden" name="product_id" value={{$product->id}}>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 ">
            <img src={{asset($product->image)}} class="w-50" alt="">
        </div>
        <div class="col-md-6">
            <h2 class="text-center">{{ $product->name}}</h2>
<p>
    description: <br> {{ $product->description}}
</p>
      
@if ($product->qty > 0)
    <span class="bg-success text-white ps-2 pe-2">in sTock</span>
@else
<span class="bg-danger text-white ps-2 pe-2">out of sTock</span>
@endif
<br>
@if ($product->sale == 0)
    PRICE: {{$product->price}} USD
@else
PRICE: <span style=" text-decoration: line-through;">{{$product->price}} </span> <span>{{$product->sale}} </span> USD
@endif
@if ($product->qty > 0)
  <br> 
  <input type="number" value="1" name="qty" id="" max={{$product->qty}} min="0">
  <br> 
    
@else

@endif

<br> TAX: {{$product->tax}} % <br>
FREE-SHIPPING<br>
@if ($product->qty > 0)
<button class="site-button btn " type="submit">ADD-TO-CART</button>
   
    <a href={{route("addtowishlist",["id"=>$product->id])}} class="site-button btn ">ADD-TO-WHISHLIST</a>
    
@else

@endif


        </div>
    </div>
</div>

</form>

@endsection