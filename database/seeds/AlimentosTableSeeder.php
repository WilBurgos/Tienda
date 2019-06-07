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
            ['nombre'=>'CHILAQUILES VERDES/ROJOS',      'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559453544],
            ['nombre'=>'CHILAQUILES C/POLLO',           'tipoComida'=> 'COMIDA','precio'=> 51,'codigo' => 1578973544],
            ['nombre'=>'CHILAQUILES C/RES',             'tipoComida'=> 'COMIDA','precio'=> 57,'codigo' => 1559273544],
            ['nombre'=>'CHILAQUILES GRATINADOS',        'tipoComida'=> 'COMIDA','precio'=> 42,'codigo' => 1559173544],
            ['nombre'=>'CHILAQUILES MIXTOS',            'tipoComida'=> 'COMIDA','precio'=> 37,'codigo' => 1555673544],
            ['nombre'=>'PIEZA DE HUEVO EXTRA',          'tipoComida'=> 'COMIDA','precio'=> 8, 'codigo' => 1559889544],
            ['nombre'=>'HUEVOS C/JAMÓN',                'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559654544],
            ['nombre'=>'HUEVOS C/CHORIZO',              'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559873505],
            ['nombre'=>'HUEVOS C/TOCINO',               'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559873554],
            ['nombre'=>'HUEVOS C/SALCHICHA',            'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559870644],
            ['nombre'=>'HUEVOS C/CHAMPIÑONES',          'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559873544],
            ['nombre'=>'HUEVOS A LA MEXICANA',          'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559563544],
            ['nombre'=>'HUEVOS ESTRELLADOS',            'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559873544],
            ['nombre'=>'HUEVOS RANCHEROS',              'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1550273544],
            ['nombre'=>'HUEVOS DIVORCIADOS',            'tipoComida'=> 'COMIDA','precio'=> 35,'codigo' => 1559873544],
            ['nombre'=>'OMELETTE',                      'tipoComida'=> 'COMIDA','precio'=> 43,'codigo' => 1550773544],
            ['nombre'=>'GUARNICIÓN DE CHILAQUILES',     'tipoComida'=> 'COMIDA','precio'=> 8, 'codigo' => 1559873544],
            ['nombre'=>'COMBINACION ANTONIO´S',         'tipoComida'=> 'COMIDA','precio'=> 52,'codigo' => 1578873544],
            ['nombre'=>'HOT CAKES',                     'tipoComida'=> 'COMIDA','precio'=> 40,'codigo' => 1559873544],
            ['nombre'=>'CAFE EN AGUA',                  'tipoComida'=> 'BEBIDA','precio'=> 12,'codigo' => 1535873544],
            ['nombre'=>'CAFE EN LECHE',                 'tipoComida'=> 'BEBIDA','precio'=> 14,'codigo' => 1559873544],
            ['nombre'=>'CAFE DE OLLA',                  'tipoComida'=> 'BEBIDA','precio'=> 12,'codigo' => 1559873544],
            ['nombre'=>'AVENA',                         'tipoComida'=> 'BEBIDA','precio'=> 15,'codigo' => 1579873544],
            ['nombre'=>'CAFE EN AGUA',                  'tipoComida'=> 'BEBIDA','precio'=> 12,'codigo' => 1559873544],
            ['nombre'=>'CHOCOLATE',                     'tipoComida'=> 'BEBIDA','precio'=> 15,'codigo' => 1129873544],
            ['nombre'=>'CHOCOMILK',                     'tipoComida'=> 'BEBIDA','precio'=> 15,'codigo' => 1559873544],
            ['nombre'=>'LICUADO DE FRESA',              'tipoComida'=> 'BEBIDA','precio'=> 18,'codigo' => 1557873544],
            ['nombre'=>'LICUADO DE PLATANO',            'tipoComida'=> 'BEBIDA','precio'=> 18,'codigo' => 1575373544],
            ['nombre'=>'JUGO DE NARANJA',               'tipoComida'=> 'BEBIDA','precio'=> 13,'codigo' => 1551373544],
            ['nombre'=>'JUGO DE ZANAHORIA',             'tipoComida'=> 'BEBIDA','precio'=> 13,'codigo' => 1999873544],
            ['nombre'=>'JUGO DE TORONJA',               'tipoComida'=> 'BEBIDA','precio'=> 13,'codigo' => 1335873544],
            ['nombre'=>'JUGO MIXTO',                    'tipoComida'=> 'BEBIDA','precio'=> 13,'codigo' => 1001873544],
            ['nombre'=>'REFRESCO DE LATA',              'tipoComida'=> 'BEBIDA','precio'=> 12,'codigo' => 1453873544],
            ['nombre'=>'REFRESCO DE LATA LIGHT',        'tipoComida'=> 'BEBIDA','precio'=> 13,'codigo' => 1545273544],
            ['nombre'=>'REFRESCO 1/2 LITRO TAPAROSCA',  'tipoComida'=> 'BEBIDA','precio'=> 14,'codigo' => 1545873544],
            ['nombre'=>'REFRESCO 1/2 LITRO LIGHT',      'tipoComida'=> 'BEBIDA','precio'=> 15,'codigo' => 1475873544],
            ['nombre'=>'AGUA FRESCA',                   'tipoComida'=> 'BEBIDA','precio'=> 9, 'codigo' => 1259873544],
        ]);
    }
}
