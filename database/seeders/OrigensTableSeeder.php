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
        DB::table('origems')->insert(['descricao' => 'Não definido']); 
        DB::table('origems')->insert(['descricao' => 'Almoxarifado']);
        DB::table('origems')->insert(['descricao' => 'Assessoria de Comunicação']);
        DB::table('origems')->insert(['descricao' => 'Central Farmacêutica']);
        DB::table('origems')->insert(['descricao' => 'Desenvolvimento Humano']);
        DB::table('origems')->insert(['descricao' => 'Diretoria de Contratos']);
        DB::table('origems')->insert(['descricao' => 'Diretoria de Imunização']);
        DB::table('origems')->insert(['descricao' => 'Diretoria de Transportes']);
        DB::table('origems')->insert(['descricao' => 'Diretoria Manutenção e Serviços']);
        DB::table('origems')->insert(['descricao' => 'Diretoria Tecnologia e Informação']);
        DB::table('origems')->insert(['descricao' => 'Distrito Eldorado']);
        DB::table('origems')->insert(['descricao' => 'Distrito Industrial']);
        DB::table('origems')->insert(['descricao' => 'Distrito Nacional']);
        DB::table('origems')->insert(['descricao' => 'Distrito Petrolândia']);
        DB::table('origems')->insert(['descricao' => 'Distrito Ressaca']);
        DB::table('origems')->insert(['descricao' => 'Distrito Riacho']);
        DB::table('origems')->insert(['descricao' => 'Distrito Sede']);
        DB::table('origems')->insert(['descricao' => 'Distrito Vargem das Flores']);
        DB::table('origems')->insert(['descricao' => 'Gabinete SMS']);
        DB::table('origems')->insert(['descricao' => 'Nutrição']);
        DB::table('origems')->insert(['descricao' => 'Patrimônio']);
        DB::table('origems')->insert(['descricao' => 'Reabilitação']);
        DB::table('origems')->insert(['descricao' => 'Recursos Humanos']);
        DB::table('origems')->insert(['descricao' => 'SAD']);
        DB::table('origems')->insert(['descricao' => 'SAE']);
        DB::table('origems')->insert(['descricao' => 'SAE/SURG']);
        DB::table('origems')->insert(['descricao' => 'SAMU']);
        DB::table('origems')->insert(['descricao' => 'SAS']);
        DB::table('origems')->insert(['descricao' => 'SAS/SAE']);
        DB::table('origems')->insert(['descricao' => 'SAS/SAE/SURG']);
        DB::table('origems')->insert(['descricao' => 'SAS/SISVAN']);
        DB::table('origems')->insert(['descricao' => 'SAS/SUR/SVS']);
        DB::table('origems')->insert(['descricao' => 'Saúde Bucal']);
        DB::table('origems')->insert(['descricao' => 'Saúde Mental']);
        DB::table('origems')->insert(['descricao' => 'SSA']);
        DB::table('origems')->insert(['descricao' => 'SUR']);
        DB::table('origems')->insert(['descricao' => 'SURG']);
        DB::table('origems')->insert(['descricao' => 'SURGH']);
        DB::table('origems')->insert(['descricao' => 'SURGH/SAS']);
        DB::table('origems')->insert(['descricao' => 'SVS']);
        DB::table('origems')->insert(['descricao' => 'SVS/DVAZ']);

    }
}
