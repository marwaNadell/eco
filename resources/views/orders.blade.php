@extends("layout")
@section("title","ORDERS")
@section("content")



@foreach ($order_items as $item)
   <div class="bg-warning m-5 fs-2">ORDER-ID::<span class="text-danger"> {{$item->id}}</span>
   ALL-PRICE <span class="text-danger">{{$item->all_price}}</span>
 DATE::  <span class="text-danger"> {{$item->created_at}}</span>
 <a href={{route("ordersdetail",["id"=>$item->id])}} class="btn btn-success w-100 ">MORE DETAILS</a>
</div>
@endforeach






@endsection