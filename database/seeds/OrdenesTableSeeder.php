<?php

use Illuminate\Database\Seeder;

class OrdenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordenes')->insert([
        	[
        		'idMesero'		=> 2,
        		'idCliente'		=> 4,
        		'folioOrden'	=> 1559453544,
                'numMesa'	    => 4,
                'diaOrden'      => '2019-06-05',
                'estatusOrden'  => 'CONSUMIENDO',
                'totalOrden'    => 0
            ],
            [
        		'idMesero'		=> 2,
        		'idCliente'		=> 2,
        		'folioOrden'	=> 1551423544,
                'numMesa'	    => 2,
                'diaOrden'      => '2019-06-05',
                'estatusOrden'  => 'PENDIENTE',
                'totalOrden'    => 0
            ],
            [
        		'idMesero'		=> 2,
        		'idCliente'		=> 6,
        		'folioOrden'	=> 1551475544,
                'numMesa'	    => 2,
                'diaOrden'      => '2019-06-05',
                'estatusOrden'  => 'PAGADA',
                'totalOrden'    => 58
            ]
        ]);
    }
}
