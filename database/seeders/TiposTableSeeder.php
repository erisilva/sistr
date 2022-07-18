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

    DB::table('tipos')->insert(['descricao' => 'COMPRAS']);
    DB::table('tipos')->insert(['descricao' => 'REGISTRO PREÇOS']);
    DB::table('tipos')->insert(['descricao' => 'PRORROGAÇÃO']);
    DB::table('tipos')->insert(['descricao' => 'ADITIVO']);
    DB::table('tipos')->insert(['descricao' => 'ADESÃO']);
    DB::table('tipos')->insert(['descricao' => 'RATEIO']);
    DB::table('tipos')->insert(['descricao' => 'EMPENHO']);
    DB::table('tipos')->insert(['descricao' => 'CREDENCIAMENTO']);
    DB::table('tipos')->insert(['descricao' => 'LOCAÇÃO']);

    }
}
