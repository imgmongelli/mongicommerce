<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailValue extends Model
{
    use HasFactory;

    public function detail(){
        return $this->belongsTo(Detail::class,'detail_id');
    }

}
