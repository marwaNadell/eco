@extends("layout")
@section("title","procced")
@section("content")


<div class="container text-center mt-5 procced-form">
<form action={{route("addorder")}} method="post">
  @csrf
    <div class="row">
<div class="col-md-6 ">
    <input type="text" class="form-control" name="first_name" placeholder="first name" >
    <input type="text" class="form-control" name="last_name" placeholder="last name" >
    <input type="number" class="form-control" name="phone" placeholder="phone" >
    <input type="email" class="form-control" name="email" placeholder="email">

    <input type="text" class="form-control" name="address_1" placeholder="address 1" >
    <input type="text" class="form-control" name="address_2" placeholder="address 2" >
    <input type="text" class="form-control" name="country" placeholder="country" >
    <input type="text" class="form-control" name="city" placeholder="city" >
    <input type="text" class="form-control" name="pin_code" placeholder="Pin" >


</div>




















<div class="col-md-6">
    

<table class="table">
    <thead>
      <tr>
        <th>IMAGE</th>
        <th>price</th>
        <th>PRO NAME</th>
        <th>QUANTITY</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cart as $item)
      <tr>
        <td><img src={{$item->product->image}} class="w-25" alt=""></td>
        <td>{{$item->price}}</td>
        <td>{{$item->product->name}}</td>
        <td>{{$item->qty}}</td>
      </tr>
      @endforeach
      
      
    </tbody>
  </table>
  <div class="d-flex justify-content-between w-100"><h3>TOTAL PRICE:

</h3> <h3>{{$total_price}}  usd</h3></div>
<div>
    <button type="submit" name="method" value="cod" class="btn btn-primary w-100">COD | CASH ON DELEVIRY</button>
    <button type="submit" name="method" value="paypal" class="btn btn-warning w-100"><i class="fa-brands fa-paypal"></i> PAYPAL</button>

</div>
</div>
    </div>
  </form>
</div>








@endsection