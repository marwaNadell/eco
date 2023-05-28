<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function gohome(){

    $products=    Product::paginate(5);
    $treands=    Product::where("treandy",1)->paginate(3);
        return view("home",compact("products","treands"));
    }
    public function product($slug=null,$id=null){

        $product=    Product::find($id);
        
            return view("product",compact("product"));
        }



    public function godashboard(){

        return view("dashboard");
    }

    public function goregister(){

        return view("register");
    }

    public function signup(Request $request){
        $user=  $request->validate(["name"=>"required|string","email"=>"required|unique:users,email","password"=>"required|confirmed"]);
       
           if(User::count()==0){
           User::create(["name"=>$request->name,"password"=>Hash::make($request->password),"email"=>$request->email,"role"=>1]);
          Auth::attempt($user);
          return view("dashboard");
           }else{
              User::create(["name"=>$request->name,"password"=>Hash::make($request->password),"email"=>$request->email,"role"=>0]);
            Auth::attempt($user);
            return redirect()->route("home");
           }
      
    }

    public function signin(){

        return view("login");
    }
public function login(Request $request){

$user=$request->validate(["email"=>"required","password"=>"required"]);
//return $user;
if(Auth::attempt($user)==1){
    if(Auth::user()->role==1){
        return view("dashboard");
    }else{
        return redirect()->route("home");
    }
   
}else{
    return redirect()->back()->with("msg","sorry email may be not correct or password") ;
}


}


    public function logout(){

        Auth::logout();
        return redirect()->route("home");
    }

    public function addcate(){

        return view("addcate");
    }

    public function insertcate(Request $request){
 $request->validate(["name"=>"required|unique:categories,name","slug"=>"required|unique:categories,slug"
 ,"image"=>"required"
    ]);
        
       $file= $request->file("image");
$ext=$file->getClientOriginalExtension();
$new_name=time().".".$ext;
$file->move("images",$new_name);

Category::create(["name"=>$request->name,"slug"=>$request->slug,
"image"=>"images"."/".$new_name
]);

return back()->with("msg","category added ");
    }


    public function showcate(){

        $cate=Category::all();

        return view("categories",compact("cate"));
    }

    public function editcate($id=null){
             
        $cate=Category::find($id);

        return view("editcate",compact("cate"));
    }
    public function changecate(Request $request,$id=null){
          $request->validate(["name"=>"required","slug"=>"required",
       "image"=>"file"   
    ]);   
    $cate=Category::find($id);
    if($request->has("image")){

if(File::exists($cate->image))     
File::delete($cate->image);

$file= $request->file("image");
$ext=$file->getClientOriginalExtension();
$new_name=time().".".$ext;
$file->move("images",$new_name);

$cate->update(["name"=>$request->name,"slug"=>$request->slug,"image"=>"images"."/".$new_name]);   
     
        return redirect("categories");
    }


    $cate->update(["name"=>$request->name,"slug"=>$request->slug]);   
     
        return redirect("categories");
    }


    public function delcate($id=null){
        $cate=Category::find($id);
        if(File::exists($cate->image)){
            File::delete($cate->image);
        }
 Category::where("id",$id)->delete();

return redirect("categories");

    }

    public function addproduct(){
$cate=Category::all();
        return view("addproduct",compact("cate"));
    }
    public function insertproduct(Request $request){
$product=$request->validate(["name"=>"required|string"
,"qty"=>"required|numeric","price"=>"required|numeric",
"sale"=>"required|numeric",
  "description"=>"required|string",
"category_id"=>"required|numeric","slug"=>"required|string",
"treandy"=>"required|boolean",
"tax"=>"required|numeric","image"=>"required|file"]);

$file=$request->file("image");
$ext=$file->getClientOriginalExtension();
$new_file_name=time().".".$ext;
$file->move("images",$new_file_name);
Product::create(["name"=>$request->name,
"qty"=>$request->qty,
"price"=>$request->price,
"sale"=>$request->sale,
"description"=>$request->description,
"category_id"=>$request->category_id,
"slug"=>$request->slug,
"treandy"=>$request->treandy,
"tax"=>$request->tax,
"image"=>"images"."/".$new_file_name
]);
        return back()->with("msg","Done");
     }



     public function allproducts(){


        $products=Product::get();
return view("allproduct",compact("products"));
        
     }

     public function delproduct($id){

        $prod=Product::find($id);

        if(File::exists($prod->image)){

            File::delete($prod->image);
           Product::where("id",$id)->delete();
           return back()->with("msg","deleted");
        }
        Product::where("id",$id)->delete();
        return back()->with("msg","deleted");

     }


     public function editproduct($id=null){
$cate= Category::all();

$product=Product::find($id);
        return view("editproduct",compact("cate","product"));
     }

     public function updateproduct(Request $request,$id){
        $product=$request->validate(["name"=>"required|string"
        ,"qty"=>"required|numeric","price"=>"required|numeric",
        "sale"=>"required|numeric",
          "description"=>"required|string",
        "category_id"=>"required|numeric","slug"=>"required|string",
        "treandy"=>"required|boolean",
        "tax"=>"required|numeric","image"=>"file"]);
        $product=Product::find($id);

        if($request->has("image")){
            $file= $request->file("image");
            $ext=$file->getClientOriginalExtension();
            $new_name=time().".".$ext;
            $file->move("images",$new_name);
Product::where("id",$id)->update(["name"=>$request->name,
"qty"=>$request->qty,
"price"=>$request->price,
"sale"=>$request->sale,
"description"=>$request->description,
"category_id"=>$request->category_id,
"slug"=>$request->slug,
"treandy"=>$request->treandy,
"tax"=>$request->tax,
"image"=>"images"."/".$new_name
]);






return back()->with("msg","product changed");



        }


        Product::where("id",$id)->update(["name"=>$request->name,
        "qty"=>$request->qty,
        "price"=>$request->price,
        "sale"=>$request->sale,
        "description"=>$request->description,
        "category_id"=>$request->category_id,
        "slug"=>$request->slug,
        "treandy"=>$request->treandy,
        "tax"=>$request->tax,
       
        ]);
        return back()->with("msg","product changed");

     }
}
