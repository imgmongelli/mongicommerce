<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $dates = ["created_at","updated_at"];

    public function status(){
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    public function typePayment(){
        return $this->belongsTo(TypePayment::class,'type_payment_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'order_products','order_id','product_id')->withPivot('number_products');
    }
}
