


<div class="dash-menu">
<span class="fs-1">SMART <i class="fa-brands fa-php fa-fade fs-1"></i> DASH-BOARD</span> <br>
    <a href={{route("categories")}}>Categories <i class="fa-solid fa-sitemap"></i></a>
    <hr>
    <a href={{route("addcate")}}>Add-categories<i class="fa-solid fa-plus"></i><i class="fa-solid fa-sitemap"></i></a>
    <hr>
    <a href={{route("addproduct")}}>ADD-products <i class="fa-brands fa-shopify"></i></a>  <hr>
    <a href={{route("allproducts")}}>Products<i class="fa-brands fa-shopify"></i><i class="fa-brands fa-shopify"></i><i class="fa-brands fa-shopify"></i></a> <hr>
   
    <a href="#">Users <i class="fa-solid fa-users"></i></a> <hr>
  
    <a href="#">Admins <i class="fa-solid fa-user-secret"></i></a> <hr>
    <a href="#">Coupons <i class="fa-regular fa-file"></i></a> <hr>
    
</div>

@yield("dash-content")