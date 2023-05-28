<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable=["name"
                      ,"qty","price",
                     "sale",
                        "description",
                "category_id","slug",
                "treandy",
                    "tax","image"
];


public function category(){

    return $this->BelongsTo(Category::class);
}

public function carts(){

    return $this->hasMany(Cart::class);
}

public function users(){

    return $this->belongsToMany(User::class,"user_product");
}
public function orderitems(){

    return $this->hasMany(Orderitem::class);
}
}
