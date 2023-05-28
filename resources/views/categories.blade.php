@extends("dashlayout")
@extends("layout")
@section("title","home")
@section("dash-content")



<div class="dash-content text-center">
    <h2>ALL CATEGORIES</h2>

<div class="container">

    <div class="row">
        @foreach ($cate as $item )
            <div class="col-md-4 mt-5">
                <img src={{$item->image}} class="w-100" style="height:100px" alt="">
                <h2>{{$item->name}}</h2>
                <a class="btn btn-danger" href={{url("del-categories/".$item->id)}}>DELETE</a><a class="btn btn-primary" href={{url("edit-categories"."/".$item->id)}}>EDIT</a>
            </div>
        @endforeach
    </div>
</div>





</div>






@endsection