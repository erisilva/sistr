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
        DB::table('situacaos')->insert(['descricao' => 'ANALISE TECNICA']);
        DB::table('situacaos')->insert(['descricao' => 'CANCELADO']);
        DB::table('situacaos')->insert(['descricao' => 'CCOAF']);
        DB::table('situacaos')->insert(['descricao' => 'COMISSAO CREDENCIAMENTO']);
        DB::table('situacaos')->insert(['descricao' => 'COMISSAO LICITACAO']);
        DB::table('situacaos')->insert(['descricao' => 'COMPRAS']);
        DB::table('situacaos')->insert(['descricao' => 'CONCLUIDO']);
        DB::table('situacaos')->insert(['descricao' => 'CONTRATOS']);
        DB::table('situacaos')->insert(['descricao' => 'COTACAO']);
        DB::table('situacaos')->insert(['descricao' => 'DEVOLVIDO']);
        DB::table('situacaos')->insert(['descricao' => 'EMPENHADO']);
        DB::table('situacaos')->insert(['descricao' => 'FORMALIZACAO']);
        DB::table('situacaos')->insert(['descricao' => 'GABINETE SMS']);
        DB::table('situacaos')->insert(['descricao' => 'HOMOLOGACAO']);
        DB::table('situacaos')->insert(['descricao' => 'INSTRUCAO PROCESSO']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA ADITIVO']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA ARP']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA CONTRATO']);
        DB::table('situacaos')->insert(['descricao' => 'MINUTA EDITAL']);
        DB::table('situacaos')->insert(['descricao' => 'PARECER TI']);
        DB::table('situacaos')->insert(['descricao' => 'PGM']);
        DB::table('situacaos')->insert(['descricao' => 'PRAZO RECURSOS']);
        DB::table('situacaos')->insert(['descricao' => 'PREGAO AGENDADO']);
        DB::table('situacaos')->insert(['descricao' => 'PREGAO DESERTO']);
        DB::table('situacaos')->insert(['descricao' => 'PREGAO FRACASSADO']);
        DB::table('situacaos')->insert(['descricao' => 'PREGAO REAGENDADO']);
        DB::table('situacaos')->insert(['descricao' => 'RATIFICACAO']);
        DB::table('situacaos')->insert(['descricao' => 'REVOGADO']);
        DB::table('situacaos')->insert(['descricao' => 'SECRETARIA ADMINISTRACAO']);
        DB::table('situacaos')->insert(['descricao' => 'SOLICITANTE']);
        DB::table('situacaos')->insert(['descricao' => 'SUPLAN']);
        DB::table('situacaos')->insert(['descricao' => 'SUSPENSO']);
        DB::table('situacaos')->insert(['descricao' => 'VISTORIA IMOVEL']);

    }
}
