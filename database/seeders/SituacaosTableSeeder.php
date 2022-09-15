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
                DB::table('situacaos')->insert(['descricao' => 'Não definido']); 
                DB::table('situacaos')->insert(['descricao' => 'Cancelado']); 
                DB::table('situacaos')->insert(['descricao' => 'CCOAF']); 
                DB::table('situacaos')->insert(['descricao' => 'Comissão de Credenciamento']); 
                DB::table('situacaos')->insert(['descricao' => 'Concluído']); 
                DB::table('situacaos')->insert(['descricao' => 'Cotando']); 
                DB::table('situacaos')->insert(['descricao' => 'Devolvido']); 
                DB::table('situacaos')->insert(['descricao' => 'Diretoria de Compras']); 
                DB::table('situacaos')->insert(['descricao' => 'Empenhado']); 
                DB::table('situacaos')->insert(['descricao' => 'Gabinete SMS']); 
                DB::table('situacaos')->insert(['descricao' => 'Homologação']); 
                DB::table('situacaos')->insert(['descricao' => 'Minuta de Aditivo']); 
                DB::table('situacaos')->insert(['descricao' => 'Minuta de ARP']); 
                DB::table('situacaos')->insert(['descricao' => 'Minuta de Contrato']); 
                DB::table('situacaos')->insert(['descricao' => 'Minuta de Edital']); 
                DB::table('situacaos')->insert(['descricao' => 'PGM']); 
                DB::table('situacaos')->insert(['descricao' => 'Pregão agendado']); 
                DB::table('situacaos')->insert(['descricao' => 'Ratificação']); 
                DB::table('situacaos')->insert(['descricao' => 'Revogado']); 
                DB::table('situacaos')->insert(['descricao' => 'Saneando pendências']); 
                DB::table('situacaos')->insert(['descricao' => 'Secretaria de Administração']); 
                DB::table('situacaos')->insert(['descricao' => 'Solicitante']); 
                DB::table('situacaos')->insert(['descricao' => 'SUPLAN']); 
                DB::table('situacaos')->insert(['descricao' => 'Suspenso']); 
                DB::table('situacaos')->insert(['descricao' => 'Vistoria do imóvel']);

    }
}
