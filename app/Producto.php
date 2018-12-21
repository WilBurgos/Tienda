<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $filliable = [
    	'idProveedor',
    	'NombreProducto',
    	'Estatus'
    ];

    public function proveedor(){
    	return $this->belongsTo('App\Proveedor', 'id', 'idProveedor');
    }

    public function almacen(){
    	return $this->belongsTo('App\Almacen','idProducto','id');
    }
}
