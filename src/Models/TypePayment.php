<?php

namespace Mongi\Mongicommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    use HasFactory;

    protected $table = 'payment_type';

    public const STRIPE = 1;
    public const BONIFICO = 2;
    public const IN_NEGOZIO = 3;
}
