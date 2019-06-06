<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $fillable = [
        'idOrden',
        'diaVenta',
        'totalVenta'
    ];

    public function orden(){
    	return $this->hasOne('App\Ordenes', 'id', 'idOrden');
    }
}
