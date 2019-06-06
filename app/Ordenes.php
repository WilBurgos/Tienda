<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $table = 'ordenes';
    protected $fillable = [
        'idMesero',
        'idCliente',
        'folioOrden',
        'numMesa',
        'estatusOrden',
        'diaOrden',
        'totalOrden'
    ];

    public function mesero(){
    	return $this->belongsTo('App\User','idMesero','id');
    }
    
    public function ordenAlimento(){
    	return $this->hasMany('App\OrdenAlimentos','idOrden','id');
    }

    public function cliente(){
    	return $this->hasOne('App\Clientes', 'id', 'idCliente');
    }

    public function ventas(){
    	return $this->belongsTo('App\Ventas','id','idCliente');
    }
}
