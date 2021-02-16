<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $dates = ["created_at","updated_at"];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    static function emptyCart(){
        self::where('user_id',Auth::user()->id)->delete();
    }


}
