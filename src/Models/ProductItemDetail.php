<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItemDetail extends Model
{
    use HasFactory;

    public function detail(){
        return $this->belongsTo(DetailValue::class,'product_detail_value_id');
    }
}
