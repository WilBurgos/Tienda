<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AlimentosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(OrdenesTableSeeder::class);
        $this->call(OrdenesAlimentosTableSeeder::class);
        $this->call(VentasTableSeeder::class);
    }
}
