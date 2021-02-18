<?php


namespace Mongi\Mongicommerce\Models;


use Mongi\Mongicommerce\Models\User;
use Illuminate\Database\Eloquent\Model;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\TypePayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $dates = ["created_at","updated_at"];

    public function status(){
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    public function typePayment(){
        return $this->belongsTo(TypePayment::class,'payment_type_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->belongsToMany(ProductItem::class,'product_order','order_id','product_item_id')->withPivot('number_products');
    }
}
