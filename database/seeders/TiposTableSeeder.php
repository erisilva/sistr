<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('tipos')->insert(['descricao' => 'Não definido']); 
            DB::table('tipos')->insert(['descricao' => 'Aditivo']);
            DB::table('tipos')->insert(['descricao' => 'Aquisição']);
            DB::table('tipos')->insert(['descricao' => 'Credenciamento']);
            DB::table('tipos')->insert(['descricao' => 'Empenho']);
            DB::table('tipos')->insert(['descricao' => 'Locação de imóvel']);
            DB::table('tipos')->insert(['descricao' => 'Rateio']);
            DB::table('tipos')->insert(['descricao' => 'Registro de Preços']);
            DB::table('tipos')->insert(['descricao' => 'Serviços']);


    }
}
