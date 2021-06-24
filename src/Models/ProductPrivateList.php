<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrivateList extends Model
{
    use HasFactory;

    protected $table = 'product_private_list';

    public function infoProduct(){
        return $this->belongsTo(Product::class, 'product_id');
    }


}
