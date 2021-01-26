<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfigurationField extends Model
{
    use HasFactory;

    public function field(){
        return $this->belongsTo(ConfigurationField::class,'config_field_id');
    }

}
