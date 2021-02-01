<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $dates = ["created_at","updated_at"];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


}
