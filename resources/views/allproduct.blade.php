@extends("dashlayout")
@extends("layout")
@section("title","home")
@section("dash-content")



<div class="dash-content text-center">
@if (session()->has("msg"))
    
<h3  class="alert alert-danger" role="alert"   >{{session()->get("msg")}}</h3>

    
@endif  

<div class="container">

    <div class="row">
@foreach ($products as $product )
    <div class="col-md-4 mt-5">
        <img class="w-100" style="height:200px;"  src={{$product->image}} alt="">
       NAME: {{$product->name}} <br>
       CATEGORY: {{$product->category->name}}
      <br> <a class="btn btn-danger" href={{url("deleteproduct/$product->id")}}>DELETE</a><a class="btn btn-primary" href={{url("/editproduct"."/".$product->id)}}>EDIT</a>
    </div>
@endforeach

    </div>

</div>

</div>






@endsection