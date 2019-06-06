<?php

use Illuminate\Database\Seeder;

class VentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ventas')->insert([
        	[
        		'idOrden'		=> 3,
        		//'idCliente'		=> 'wil9517@hotmail.com',
        		//'idMesero'      => bcrypt('BUMW950330'),
                'diaVenta'      => '2019-06-04',
                'totalVenta'    => 58
            ],
            // [
            //     'idOrden'	    => 'MESERO',
        	// 	'idCliente'	    => 'mesero@mail.com',
        	// 	'idMesero'  	=> bcrypt('MESERO'),
            //     'diaVenta'  	=> 'MESERO',
            //     'totalVenta'    => 'ACTIVO'
            // ]
        ]);
    }
}
