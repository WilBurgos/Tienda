<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
        	[
        		'nombre'		=> 'MARCO',
        		'primerAp'		=> 'HERNÁNDEZ',
        		'segundoAp'     => 'RAMIREZ',
                'numVisitas'	=> 1
            ],
            [
        		'nombre'		=> 'ANA',
        		'primerAp'		=> 'FERNANDEZ',
        		'segundoAp'     => 'CRUZ',
                'numVisitas'	=> 2
            ],
            [
        		'nombre'		=> 'MARTHA',
        		'primerAp'		=> 'GARCIA',
        		'segundoAp'     => 'BARRANCO',
                'numVisitas'	=> 3
            ],
            [
        		'nombre'		=> 'JOSÉ',
        		'primerAp'		=> 'TOTOL',
        		'segundoAp'     => 'MORALES',
                'numVisitas'	=> 4
            ],
            [
        		'nombre'		=> 'GREGORIO',
        		'primerAp'		=> 'RIVERA',
        		'segundoAp'     => 'LANDA',
                'numVisitas'	=> 5
            ],
            [
        		'nombre'		=> 'GABRIELA',
        		'primerAp'		=> 'PEREZ',
        		'segundoAp'     => 'CASTRO',
                'numVisitas'	=> 1
            ],
        ]);
    }
}
