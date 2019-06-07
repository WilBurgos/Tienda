<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimentos extends Model
{
    protected $table = 'alimentos';
    protected $fillable = [
        'nombre',
        'tipoComida',
        'precio',
        'codigo'
    ];

    public function alimentoOrden(){
    	return $this->belongsTo('App\OrdenAlimentos','idAlimento','id');
    }
}
