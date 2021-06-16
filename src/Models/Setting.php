<?php


namespace Mongi\Mongicommerce\Models;


use Illuminate\Database\Eloquent\Model;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'admin_settings';



}
