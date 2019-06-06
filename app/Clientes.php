<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'primerAp',
        'segundoAp',
        'numVisitas'
    ];

    public function orden(){
    	return $this->belongsTo('App\Ordenes','idCliente','id');
    }
}
