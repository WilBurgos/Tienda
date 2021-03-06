<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $fillable = [
        'compania',
        'direccion',
        'telefono',
        'correo',
    	'estatus'
    ];

    public function producto(){
    	return $this->hasMany('App\Producto', 'idProveedor', 'id');
    }
}
