@extends("layout")
@section("title","home")
@section("content")


     <h2 class="text-center">sign up now</h2>

     <div class="w-100 text-center form-register">
<form action={{route("signup")}} method="post">
    @csrf
    <input type="text" name="name" placeholder="PLEASE ENTER USER NAME" value={{old("name")}}>
    <div class="divider brand-color">
     @error('name')
     <div class="error">{{ $message }}</div>
 @enderror     
</div>
    <input type="email" name="email" placeholder="PLEASE ENTER EMAIL" value={{old("email")}}>
    <div class="divider brand-color">
     @error('email')
     <div class="error">{{ $message }}</div>
 @enderror 

    </div>
    <input type="password" name="password" placeholder="PLEASE ENTER PASSWORD">
    <div class="divider brand-color">
     @error('password')
     <div class="error">{{ $message }}</div>
 @enderror 

    </div>
    <input type="password" name="password_confirmation" placeholder="PLEASE CONFIRM YOUR PASSWORD"><div class="divider"></div>
    <button type="submit" class="btn site-button">Register Now</button>

</form>
       
     </div>







@endsection