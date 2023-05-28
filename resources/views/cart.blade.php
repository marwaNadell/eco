@extends("layout")
@section("title","cart")
@section("content")


@foreach ($cart as $item )
    <div class="bg-warning mt-5">
       
        <img class="w-25" style="height:120px" src={{asset($item->product->image)}} alt="">
        <span class=""> {{$item->product->name}}</span>
         <span class=""> {{$item->product->sale==0?$item->product->price:$item->product->sale}}</span>  
      <span  class="catchy">     <input style="width:10%" min="0" max={{$item->product->qty}} type="number" name="qty" value={{$item->qty}} id={{$item->product_id}}  class="innercatchy"   />     </span>
           <a href={{route("cartremove",["id"=>$item->product_id])}} class="btn btn-danger ">REMOVE</a>            
    
    
    </div>
@endforeach
<div class="d-flex justify-content-between">TOTAL_PRICE:<h2 id="total" class="total"></h2> <a class="text-white btn bg-dark" href={{route("showprocced")}}>PROCED PAYMENT</a></div>



    

@endsection