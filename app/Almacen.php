<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
    protected $fillable = [
    	'idProducto',
    	'Cantidad',
    	'PrecioCompra',
    	'FechaCompra',
    	'PrecioVenta',
    	'FechaSalida',
    	'Observaciones'
    ];

    public function productos(){
    	return $this->hasMany('App\Oroducto','id','idProducto');
    }
}
