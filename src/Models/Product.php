<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
