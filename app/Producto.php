<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = [
    	'idProveedor',
    	'nombreProducto',
    	'estatus'
    ];

    public function proveedor(){
    	return $this->belongsTo('App\Proveedor', 'idProveedor', 'id');
    }

    public function almacen(){
    	return $this->belongsTo('App\Almacen','idProducto','id');
    }
}
