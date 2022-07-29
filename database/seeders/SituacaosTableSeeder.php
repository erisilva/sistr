<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SituacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('situacaos')->insert(['descricao' => 'Não Definido']);
        DB::table('situacaos')->insert(['descricao' => 'CONCLUÍDO']);
        DB::table('situacaos')->insert(['descricao' => 'HOMOLOGAÇÃO']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA ARP']);
        DB::table('situacaos')->insert(['descricao' => 'PREGÃO AGENDADO']);
        DB::table('situacaos')->insert(['descricao' => 'DEVOLVIDO']);
        DB::table('situacaos')->insert(['descricao' => 'ANÁLISE TÉCNICA']);
        DB::table('situacaos')->insert(['descricao' => 'PGM']);
        DB::table('situacaos')->insert(['descricao' => 'COTAÇÃO']);        
        DB::table('situacaos')->insert(['descricao' => 'CCOAF']);
        DB::table('situacaos')->insert(['descricao' => 'ORIGEM']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA CONTRATO']);
        DB::table('situacaos')->insert(['descricao' => 'EMPENHADO']);
        DB::table('situacaos')->insert(['descricao' => 'SANEANDO PEND}ENCIAS']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA ADITIVO']);
        DB::table('situacaos')->insert(['descricao' => 'PRO']);

    }
}
