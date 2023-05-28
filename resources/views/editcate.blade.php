@extends("dashlayout")
@extends("layout")
@section("title","home")
@section("dash-content")



<div class="dash-content text-center">
    <h2>ADD CATEGORIES</h2>



    <div class="text-center">

        <form action={{url("edit-categories"."/".$cate->id)}} method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
    <input value={{$cate->name}} placeholder="category name" class="form-control mt-3" type="text" name="name" id="">
   @error("name")
   <p class="brand-color"> {{$message}}</p>
      
   @enderror
    <input value={{$cate->slug}} placeholder="slug name"  class="form-control mt-3" type="text" name="slug" id="">
    @error("slug")
    <p class="brand-color">{{$message}}</p>
       
   @enderror
    <h5>category image</h5>
    <img src={{asset($cate->image)}} alt="" class="w-100" >
    <input class="form-control mt-3"  type="file" name="image" id="">
    @error("image")
    <p class="brand-color"> {{$message}}</p>
      
   @enderror
    <button  class="form-control mt-3 site-button" type="submit">insert</button>
    
        </form>

        @if (session()->has("msg"))
        <div class="alert alert-info" role="alert">
            {{session()->get("msg")}}
        </div>
        @endif
        
    </div>












</div>






@endsection