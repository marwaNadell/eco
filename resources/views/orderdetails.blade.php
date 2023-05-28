@extends("layout")
@section("title","ORDERS-details")
@section("content")






<table class="table">
    <thead>
      <tr>
        <th scope="col">IMAGE</th>
        <th scope="col">NAME</th>
        <th scope="col">QTY</th>
        <th scope="col">PRICE</th>
       
      </tr>
    </thead>
    <tbody>
        
@foreach ($order_items as $item)
<tr>
    <td ><img src={{asset($item->product->image)}} class="w-25" alt=""></td>
    <td >{{$item->product->name}}</td>
    <td>{{$item->qty}}</td>
    <td>{{$item->product->sale==0?$item->product->price:$item->product->sale}}</td>
    
  </tr>
@endforeach
     
    
       
  
    </tbody>
  </table>




@endsection