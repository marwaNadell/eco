<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
"all_price",
"user_id",
"first_name",
"last_name",
"phone",
"email",
"address_1",
"country",
"city",
"pin_code",
"method"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderitems(){
        return $this->hasMany(Orderitem::class);
    }
}
