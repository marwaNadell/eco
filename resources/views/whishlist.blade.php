@extends("layout")
@section("title","whislist")
@section("content")




<table class="table">
    <thead>
      <tr>
       
        <th scope="col">IMAGE</th>
        <th scope="col">PRO-NAME</th>
        <th scope="col">QUNTITY</th>
        <th scope="col">REMOVE</th>
        <th scope="col">ADD</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $user->products as $item)
      <tr>
       <form action={{route("addtocart")}} method="post">
        @csrf
<input type="hidden" name="product_id" value={{$item->id}}>
<td><img  class="w-25" src={{$item->image}} alt=""></td>
        <td>{{$item->name}}</td>
        <td><input type="number"  name="qty" name="" id="" max="{{$item->qty}}" min="0" value="1"></td>
        <td><a href={{route("removefromwishlist",["id"=>$item->id])}} class="btn btn-dark">REMOVE</a></td>
        <td><button class="btn site-button"  type="submit">ADD-TO-CART</button> </td>

       </form>
        
      </tr>
      @endforeach
     
     
    </tbody>
  </table>





@endsection