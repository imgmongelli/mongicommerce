<?php

namespace Mongi\Mongicommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'statuses_order';

    public const IN_PREPARAZIONE = 1;
    public const ATTESA_PAGAMENTO = 2;
    public const CONSEGNATO_AL_CORRIERE = 3;
    public const COMPLETATO = 4;
    public const RIFIUTATO = 5;


}
