<?php

use Illuminate\Database\Seeder;

class OrdenesAlimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordenalimentos')->insert([
        	[
        		'idOrden'		=> 1,
                'idAlimento'    => 16,
                'cantidad'      => 2
            ],
            [
        		'idOrden'		=> 1,
                'idAlimento'	=> 23,
                'cantidad'      => 2
            ],
            [
        		'idOrden'		=> 2,
                'idAlimento'    => 8,
                'cantidad'      => 1
            ],
            [
        		'idOrden'		=> 2,
                'idAlimento'	=> 32,
                'cantidad'      => 1
            ],
            [
        		'idOrden'		=> 3,
                'idAlimento'    => 19,
                'cantidad'      => 1
            ],
            [
        		'idOrden'		=> 3,
                'idAlimento'	=> 28,
                'cantidad'      => 1
            ],
        ]);
    }
}
