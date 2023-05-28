<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link rel="icon" type="image/x-icon" href={{asset("fav.png")}}>
    <link rel="stylesheet" href={{asset("bootstrap.min.css")}}>
    
    <link rel="stylesheet" href={{asset("fontawesome.min.css")}}>
    <link rel="stylesheet" href={{asset("index.css")}}>
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"></script>

</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand brand-color"  href={{route("home")}}>Egyexpress</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page"  href={{route("home")}}>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Policy & privacy </a>
              </li>
              @if (auth()->check())
                
              @else
              <li class="nav-item">
                <a class="nav-link" href={{route("register")}}>Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href={{route("login")}}>Log In</a>
              </li>  
              @endif
              @auth
              <li class="nav-item">
                <a class="nav-link" href={{route("whishlist")}}>whishlist 
                  <i class="fa-solid fa-heart fa-shake brand-color"></i>
                 @php
                  $val=0;
                  $val= auth()->user()->products()->count()  ;
                 
                 echo "<span class=''>$val</span>";
                   @endphp
                   
               </a>
              </li>
              @endauth



              @auth
              <li class="nav-item">
                <a class="nav-link" href={{route("orders")}}>0RDERS 
                  <i class="fa-solid fa-box-open fa-bounce"></i>
                 
                   
               </a>
              </li>
              @endauth








              @auth
              <li class="nav-item">
                <a class="nav-link" href={{route("logout")}}>Log Out</a>
              </li>
              @endauth
              
              @auth

             @if (auth()->user()->role==1)
             <li class="nav-item">
              <a class="nav-link btn site-button" href={{route("dashboard")}}>dashboard</a>
            </li>
               @else
              
             @endif
              
             @endauth

              
            </ul>
          </div>
        </div>
      </nav>
    @yield("content")
    <div class="cart"><a href={{route("cart")}}><i class="fa-brands fa-opencart"></i>
      <h6 class="text-center">CART</h6>
      @auth
   @php
   $val=0;
   $val= auth()->user()->carts()->count()  ;
   
  echo "<span class='num-in-cart'>$val</span>";
    @endphp
   @endauth
   
      
    
    </a>
    <br> 
    </div>
<div class="bg-dark text-white footer">

  <div class="container text-center">
    <div class="row">
      <div class="col-md-4">
        <a href="">HOME</a> <br>
        <a href="">CONTACT-US</a> <br>
        <a href="">ABOUT-US</a> <br>
        <a href="">PRIVACY & POLICY</a> <br>

      </div>
      <div class="col-md-4">
        EGYPTION & CHINESE CORPOREATE

      </div>
      <div class="col-md-4 " style="font-size: 64px; color:yellow">
        
        <i class="fa-brands fa-cc-paypal fa-beat"></i>
      </div>
    </div>
  </div>
</div>
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script>
    <script src={{asset("fontawesome.min.js")}}></script>
    <script src="{{asset('jquery-3.7.0.min.js')}}"></script>
<script src={{asset('index.js')}}></script>
</body>
</html>