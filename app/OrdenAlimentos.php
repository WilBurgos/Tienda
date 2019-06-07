<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenAlimentos extends Model
{
    protected $table = 'ordenalimentos';
    protected $fillable = [
        'idOrden',
        'idAlimento',
        'cantidad'
    ];

    public function ordenes(){
    	return $this->belongsTo('App\Ordenes','idOrden','id');
    }

    public function alimento(){
    	return $this->hasOne('App\Alimentos', 'id', 'idAlimento');
    }
}
