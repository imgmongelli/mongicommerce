<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Model;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $dates = ["created_at","updated_at"];

    public function items(){
        return $this->hasMany(ProductItem::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function details(){
        return $this->hasManyThrough(ProductItemDetail::class,ProductItem::class);
    }

    public static function getPrice($product_item_id){
        return ProductItem::find($product_item_id)->price;
    }

    public static function getImage($product_item_id){
        return ProductItem::find($product_item_id)->image;
    }



}
