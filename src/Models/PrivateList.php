<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateList extends Model
{
    use HasFactory;

    protected $table = 'private_list';

    public function products(){
        return $this->hasMany(ProductPrivateList::class, 'lista_id');
    }


}
