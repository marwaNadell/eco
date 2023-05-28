<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProccedController;
use App\Http\Controllers\WhishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[AuthController::class,"gohome"])->name("home");

Route::get("/home",[AuthController::class,"gohome"])->name("home");
Route::get("/product/{slug?}/{id?}",[AuthController::class,"product"])->name("product");



Route::get("/dashboard",[AuthController::class,"godashboard"])->name("dashboard");
Route::get("/add-categories",[AuthController::class,"addcate"])->name("addcate");
Route::post("/add-categories",[AuthController::class,"insertcate"])->name("addcate");
Route::get("/categories",[AuthController::class,"showcate"])->name("categories");
Route::get("/edit-categories/{id?}",[AuthController::class,"editcate"])->name("editcate");
Route::put("/edit-categories/{id?}",[AuthController::class,"changecate"])->name("editcate");
Route::get("/del-categories/{id?}",[AuthController::class,"delcate"])->name("delcate");
Route::get("/add-product",[AuthController::class,"addproduct"])->name("addproduct");
Route::post("/add-product",[AuthController::class,"insertproduct"])->name("insertproduct");
Route::get("/products",[AuthController::class,"allproducts"])->name("allproducts");
Route::get("/deleteproduct/{id?}",[AuthController::class,"delproduct"])->name("delproduct");
Route::get("/editproduct/{id?}",[AuthController::class,"editproduct"])->name("editproduct");
Route::post("/editproduct/{id?}",[AuthController::class,"updateproduct"])->name("updateproduct");














Route::get("/signup",[AuthController::class,"goregister"])->name("register")->middleware("AuthManage");
Route::post("/signup",[AuthController::class,"signup"])->name("signup")->middleware("AuthManage");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");
Route::get("/login",[AuthController::class,"signin"])->name("login")->middleware("AuthManage");
Route::post("/login",[AuthController::class,"login"])->name("login")->middleware("AuthManage");
Route::post("addtocart",[CartController::class,"addtocart"])->name("addtocart");
Route::get("cart",[CartController::class,"getall"])->name("cart");
Route::get("cartremove/{id?}",[CartController::class,"cartremove"])->name("cartremove");
Route::post("cartedit",[CartController::class,"cartedit"])->name("cartedit");
Route::get("carttotal",[CartController::class,"carttotal"])->name("carttotal");
//WhishlistController 

Route::get("addtowishlist/{id?}",[WhishlistController::class,"index"])->name("addtowishlist");
Route::get("removefromwishlist/{id?}",[WhishlistController::class,"remove"])->name("removefromwishlist");

Route::get("whishlist",[WhishlistController::class,"showwhishlist"])->name("whishlist");
Route::get("procced",[ProccedController::class,"showprocced"])->name("showprocced");
Route::post("addorder",[PaymentController::class,"addorder"])->name("addorder");

Route::get("orders",[OrderController::class,"index"])->name("orders");
Route::get("ordersdetail/{id?}",[OrderController::class,"ordersdetail"])->name("ordersdetail");





//Route::post('createpaypal',[PaymentController::class,'createpaypal'])->name('createpaypal');

//Route::get('processPaypal',[PaymentController::class,'processPaypal'])->name('processPaypal');

Route::get('processSuccess',[PaymentController::class,'processSuccess'])->name('processSuccess');

Route::get('processCancel',[PaymentController::class,'processCancel'])->name('processCancel');

