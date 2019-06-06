<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name'		=> 'WILBERT',
        		'email'		=> 'wil9517@hotmail.com',
        		'password'	=> bcrypt('BUMW950330'),
                'ocupation'	=> 'GERENTE',
                'estatus'   => 'ACTIVO'
            ],
            [
                'name'		=> 'MESERO',
        		'email'		=> 'mesero@mail.com',
        		'password'	=> bcrypt('MESERO'),
                'ocupation'	=> 'MESERO',
                'estatus'   => 'ACTIVO'
            ]
        ]);
    }
}
