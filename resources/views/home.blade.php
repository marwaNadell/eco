@extends("layout")
@section("title","home")
@section("content")


<div class="main-img" >

 <h2 class="text-center text-white fs-1 glass-bg">WELCOME TO OUR <br/> STORE</h2>
</div>

<div class="text-center">
    <h2>ALL PRODUCTS</h2>
    <div class="container">
        <div class="row">

          @foreach ($products as $item)
         
            <div class="col-md-4">
                <a href={{route("product",["slug"=>$item->slug,"id"=>$item->id])}} style="text-decoration:none; color:black">

            <img src={{$item->image}} style="height:200px;" alt="" class="w-100">
            @if ($item->sale==0)
              {{ $item->price}} usd
            @else
            <span style=" text-decoration: line-through;">{{$item->price}} usd </span> 
            <span>{{$item->sale}} usd </span>    
          
            @endif
        </a>
          </div>
        
          @endforeach
        </div>
    </div>
    {{$products->links("pagination::bootstrap-5")}}
</div>


















<div class="text-center">
    <h2>Treandy PRODUCTS</h2>
    <div class="container">
        <div class="row">

          @foreach ($treands as $item)
          <div class="col-md-4">
            <a href={{route("product",["slug"=>$item->slug,"id"=>$item->id])}} style="text-decoration:none; color:black">

            <img src={{$item->image}} style="height:200px;" alt="" class="w-100">
            @if ($item->sale==0)
              {{ $item->price}} usd
            @else
            <span style=" text-decoration: line-through;">{{$item->price}} usd </span> 
            <span>{{$item->sale}} usd </span>    
            @endif
        </a>
          </div>
        
          @endforeach
        </div>
    </div>
    {{$treands->links("pagination::bootstrap-5")}}
</div>





@endsection