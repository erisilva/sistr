<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class OrigensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // mudou o título para solicitante

DB::table('origems')->insert(['descricao' => 'Não definido']);   
DB::table('origems')->insert(['descricao' => 'ALMOXARIFADO']);
DB::table('origems')->insert(['descricao' => 'CAE IRIA DINIZ']);
DB::table('origems')->insert(['descricao' => 'CAPS']);
DB::table('origems')->insert(['descricao' => 'CAPS AD']);
DB::table('origems')->insert(['descricao' => 'CAPS I']);
DB::table('origems')->insert(['descricao' => 'CCE RESSACA']);
DB::table('origems')->insert(['descricao' => 'CCZ']);
DB::table('origems')->insert(['descricao' => 'CEAPS']);
DB::table('origems')->insert(['descricao' => 'CENTRAL FARMACEUTICA']);
DB::table('origems')->insert(['descricao' => 'COMPRAS']);
DB::table('origems')->insert(['descricao' => 'COMUNICACAO']);
DB::table('origems')->insert(['descricao' => 'CONTRATOS']);
DB::table('origems')->insert(['descricao' => 'DESENVOLVIMENTO HUMANO']);
DB::table('origems')->insert(['descricao' => 'DISTRITO ELDORADO']);
DB::table('origems')->insert(['descricao' => 'DISTRITO INDUSTRIAL']);
DB::table('origems')->insert(['descricao' => 'DISTRITO NACIONAL']);
DB::table('origems')->insert(['descricao' => 'DISTRITO PETROLANDIA']);
DB::table('origems')->insert(['descricao' => 'DISTRITO RESSACA']);
DB::table('origems')->insert(['descricao' => 'DISTRITO RIACHO']);
DB::table('origems')->insert(['descricao' => 'DISTRITO SEDE']);
DB::table('origems')->insert(['descricao' => 'DISTRITO VARGEM FLORES']);
DB::table('origems')->insert(['descricao' => 'ENGENHARIA E OBRAS']);
DB::table('origems')->insert(['descricao' => 'GABINETE SMS']);
DB::table('origems')->insert(['descricao' => 'IMUNIZACAO']);
DB::table('origems')->insert(['descricao' => 'MANUTENCAO']);
DB::table('origems')->insert(['descricao' => 'NUTRICAO']);
DB::table('origems')->insert(['descricao' => 'PATRIMONIO']);
DB::table('origems')->insert(['descricao' => 'REABILITACAO']);
DB::table('origems')->insert(['descricao' => 'RECURSOS HUMANOS']);
DB::table('origems')->insert(['descricao' => 'SAD']);
DB::table('origems')->insert(['descricao' => 'SAE']);
DB::table('origems')->insert(['descricao' => 'SAE/SUR']);
DB::table('origems')->insert(['descricao' => 'SAE/SURG']);
DB::table('origems')->insert(['descricao' => 'SAE/SVS']);
DB::table('origems')->insert(['descricao' => 'SAMU']);
DB::table('origems')->insert(['descricao' => 'SAS']);
DB::table('origems')->insert(['descricao' => 'SAS/SAE']);
DB::table('origems')->insert(['descricao' => 'SAS/SUR']);
DB::table('origems')->insert(['descricao' => 'SAS/SURG']);
DB::table('origems')->insert(['descricao' => 'SAS/SVS']);
DB::table('origems')->insert(['descricao' => 'SAUDE BUCAL']);
DB::table('origems')->insert(['descricao' => 'SAUDE MENTAL']);
DB::table('origems')->insert(['descricao' => 'SSA']);
DB::table('origems')->insert(['descricao' => 'SUR']);
DB::table('origems')->insert(['descricao' => 'SUR/SVS']);
DB::table('origems')->insert(['descricao' => 'SURG']);
DB::table('origems')->insert(['descricao' => 'SURG/SUR']);
DB::table('origems')->insert(['descricao' => 'SURG/SVS']);
DB::table('origems')->insert(['descricao' => 'SVS']);
DB::table('origems')->insert(['descricao' => 'TI']);
DB::table('origems')->insert(['descricao' => 'TRANSPORTES']);
    }
}
