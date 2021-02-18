<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Model;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\ProductItemDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mongi\Mongicommerce\Models\ProductConfigurationField;

class ProductItem extends Model
{
    use HasFactory;

    public function details(){
        return $this->hasMany(ProductItemDetail::class,'product_item_id');
    }

    public function configurationFields(){
        return $this->hasMany(ProductConfigurationField::class,'product_item_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
