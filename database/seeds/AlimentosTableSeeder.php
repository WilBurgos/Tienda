<?php

use Illuminate\Database\Seeder;

class AlimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alimentos')->insert([
            ['nombre'=>'CHILAQUILES VERDES/ROJOS',      'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'CHILAQUILES C/POLLO',           'tipoComida'=> 'COMIDA','precio'=> 51],
            ['nombre'=>'CHILAQUILES C/RES',             'tipoComida'=> 'COMIDA','precio'=> 57],
            ['nombre'=>'CHILAQUILES GRATINADOS',        'tipoComida'=> 'COMIDA','precio'=> 42],
            ['nombre'=>'CHILAQUILES MIXTOS',            'tipoComida'=> 'COMIDA','precio'=> 37],
            ['nombre'=>'PIEZA DE HUEVO EXTRA',          'tipoComida'=> 'COMIDA','precio'=> 8],
            ['nombre'=>'HUEVOS C/JAMÓN',                'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS C/CHORIZO',              'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS C/TOCINO',               'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS C/SALCHICHA',            'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS C/CHAMPIÑONES',          'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS A LA MEXICANA',          'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS ESTRELLADOS',            'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS RANCHEROS',              'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'HUEVOS DIVORCIADOS',            'tipoComida'=> 'COMIDA','precio'=> 35],
            ['nombre'=>'OMELETTE',                      'tipoComida'=> 'COMIDA','precio'=> 43],
            ['nombre'=>'GUARNICIÓN DE CHILAQUILES',     'tipoComida'=> 'COMIDA','precio'=> 8],
            ['nombre'=>'COMBINACION ANTONIO´S',         'tipoComida'=> 'COMIDA','precio'=> 52],
            ['nombre'=>'HOT CAKES',                     'tipoComida'=> 'COMIDA','precio'=> 40],
            ['nombre'=>'CAFE EN AGUA',                  'tipoComida'=> 'BEBIDA','precio'=> 12],
            ['nombre'=>'CAFE EN LECHE',                 'tipoComida'=> 'BEBIDA','precio'=> 14],
            ['nombre'=>'CAFE DE OLLA',                  'tipoComida'=> 'BEBIDA','precio'=> 12],
            ['nombre'=>'AVENA',                         'tipoComida'=> 'BEBIDA','precio'=> 15],
            ['nombre'=>'CAFE EN AGUA',                  'tipoComida'=> 'BEBIDA','precio'=> 12],
            ['nombre'=>'CHOCOLATE',                     'tipoComida'=> 'BEBIDA','precio'=> 15],
            ['nombre'=>'CHOCOMILK',                     'tipoComida'=> 'BEBIDA','precio'=> 15],
            ['nombre'=>'LICUADO DE FRESA',              'tipoComida'=> 'BEBIDA','precio'=> 18],
            ['nombre'=>'LICUADO DE PLATANO',            'tipoComida'=> 'BEBIDA','precio'=> 18],
            ['nombre'=>'JUGO DE NARANJA',               'tipoComida'=> 'BEBIDA','precio'=> 13],
            ['nombre'=>'JUGO DE ZANAHORIA',             'tipoComida'=> 'BEBIDA','precio'=> 13],
            ['nombre'=>'JUGO DE TORONJA',               'tipoComida'=> 'BEBIDA','precio'=> 13],
            ['nombre'=>'JUGO MIXTO',                    'tipoComida'=> 'BEBIDA','precio'=> 13],
            ['nombre'=>'REFRESCO DE LATA',              'tipoComida'=> 'BEBIDA','precio'=> 12],
            ['nombre'=>'REFRESCO DE LATA LIGHT',        'tipoComida'=> 'BEBIDA','precio'=> 13],
            ['nombre'=>'REFRESCO 1/2 LITRO TAPAROSCA',  'tipoComida'=> 'BEBIDA','precio'=> 14],
            ['nombre'=>'REFRESCO 1/2 LITRO LIGHT',      'tipoComida'=> 'BEBIDA','precio'=> 15],
            ['nombre'=>'AGUA FRESCA',                   'tipoComida'=> 'BEBIDA','precio'=> 9],
        ]);
    }
}
