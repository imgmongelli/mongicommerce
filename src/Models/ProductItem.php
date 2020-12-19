<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    public function details(){
        return $this->hasMany(ProductItemDetail::class,'product_item_id');
    }

}
