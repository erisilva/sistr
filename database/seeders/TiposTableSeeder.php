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

    DB::table('tipos')->insert(['descricao' => 'ADITIVO']);
    DB::table('tipos')->insert(['descricao' => 'AQUISICAO']);
    DB::table('tipos')->insert(['descricao' => 'CREDENCIAMENTO']);
    DB::table('tipos')->insert(['descricao' => 'EMPENHO']);
    DB::table('tipos')->insert(['descricao' => 'LOCACAO MOVEL']);
    DB::table('tipos')->insert(['descricao' => 'RATEIO']);
    DB::table('tipos')->insert(['descricao' => 'REGISTRO PRECOS']);
    DB::table('tipos')->insert(['descricao' => 'SERVICO']);

    }
}
