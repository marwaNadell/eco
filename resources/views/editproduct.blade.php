@extends("dashlayout")
@extends("layout")
@section("title","home")
@section("dash-content")



<div class="dash-content text-center">
    <h2>EDIT-PRODUCT</h2>
   
 
@if(session()->has("msg"))
<h3  class="alert alert-success" role="alert"   >{{session()->get("msg")}}</h3>
@endif

    <div class="text-center">

        <form action={{route("updateproduct",$product->id)}} method="post" enctype="multipart/form-data">
    @csrf
    <input value={{$product->name}} placeholder="product name" class="form-control mt-3" type="text" name="name" id="">
   @error("name")
   <p class="brand-color"> {{$message}}</p>
      
   @enderror

   <select name="category_id" class="form-select" aria-label="Default select example" >
    <option >select category</option>
    @foreach ($cate as $item )
    <option @if($product->category->id==$item->id) selected="selected" @endif value={{$item->id}}>{{$item->name}}</option>
@endforeach
    
   </select>
    <input placeholder="slug name" value={{$product->slug}} class="form-control mt-3" type="text" name="slug" id="">
    @error("slug")
    <p class="brand-color">{{$message}}</p>
       
   @enderror

   <textarea placeholder="description" class="form-control mt-3" name="description" id="" cols="30" rows="10">
    {{$product->description}}
   </textarea>
  
   @error("description")
   <p class="brand-color">{{$message}}</p>
      
  @enderror


  <input placeholder="price" value={{$product->price}} class="form-control mt-3" type="number" name="price" id="">
    @error("price")
    <p class="brand-color">{{$message}}</p>
       
   @enderror
   <input placeholder="sale" value={{$product->sale}} class="form-control mt-3" type="number" name="sale" id="">
   @error("sale")
   <p class="brand-color">{{$message}}</p>
      
  @enderror


  <input placeholder="quantity" value={{$product->qty}} class="form-control mt-3" type="number" name="qty" id="">
  @error("qty")
  <p class="brand-color">{{$message}}</p>
     
 @enderror

 <input placeholder="tax" value={{$product->tax}} class="form-control mt-3" type="number" name="tax" id="">
 @error("tax")
 <p class="brand-color">{{$message}}</p>
    
@enderror
<h2>treandy</h2>
<label>
    <input @if($product->treandy==false) checked @endif type="radio" name="treandy" value="0" /> NOT TREANDY 
</label>

<label>
    <input @if($product->treandy==true) checked @endif type="radio" name="treandy" value="1" /> TREANDY 
</label>
@error("treandy")
    {{$message}}
@enderror
<img class="w-50" src={{asset($product->image)}} alt="">
    <h5>category image</h5>
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