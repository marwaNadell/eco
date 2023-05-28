@extends("layout")
@section("title","home")
@section("content")


     <h2 class="text-center">sign in now</h2>

     <div class="w-100 text-center form-register">
<form action={{route("login")}} method="post">
    @csrf
   
    <input type="email" name="email" placeholder="PLEASE ENTER EMAIL" >
    <div class="divider brand-color">
     @error('email')
     <div class="error">{{ $message }}</div>
 @enderror 

    </div>
    <input type="password" name="password" placeholder="PLEASE ENTER PASSWORD" >
    <div class="divider brand-color">
     @error('password')
     <div class="error">{{ $message }}</div>
 @enderror 

    </div>
<div class="divider"></div>
    <button type="submit" class="btn site-button">signin Now</button>

</form>
       
     </div>

<div class="text-center brand-color">
    @if (session()->has("msg"))
    {{session()->get("msg")}}
@endif

</div>





@endsection