<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationField extends Model
{
    use HasFactory;

    public function value(){
        return $this->belongsTo(ConfigurationFieldValue::class,'configuration_field_id');
    }


}
