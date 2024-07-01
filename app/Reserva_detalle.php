<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_detalle extends Model
{
    protected $table        = 'reservacion_detalle';
    protected $primaryKey   = 'id';
    protected $fillable     = 
    [
        'idreservacion',
        'idproducto',
        'precio',
        'cantidad',
        'estado'
    ];
}
