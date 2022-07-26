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
            DB::table('origems')->insert(['descricao' => 'ALMOXARIFADO']);
            DB::table('origems')->insert(['descricao' => 'ASCOM']);
            DB::table('origems')->insert(['descricao' => 'CONTRATOS']);
            DB::table('origems')->insert(['descricao' => 'DDH']);
            DB::table('origems')->insert(['descricao' => 'DS NACIONAL']);
            DB::table('origems')->insert(['descricao' => 'DS PETROLÂNDIA']);
            DB::table('origems')->insert(['descricao' => 'DS RESSACA']);
            DB::table('origems')->insert(['descricao' => 'DS RIACHO']);
            DB::table('origems')->insert(['descricao' => 'GABINETE']);
            DB::table('origems')->insert(['descricao' => 'MANUTENÇÃO']);
            DB::table('origems')->insert(['descricao' => 'SAE']);
            DB::table('origems')->insert(['descricao' => 'SAE/NSB']);
            DB::table('origems')->insert(['descricao' => 'SAE/REABILITAÇÃO']);
            DB::table('origems')->insert(['descricao' => 'SAE/SM']);
            DB::table('origems')->insert(['descricao' => 'SAE/SURGH']);
            DB::table('origems')->insert(['descricao' => 'SAS']);
            DB::table('origems')->insert(['descricao' => 'SAS/DAF']);
            DB::table('origems')->insert(['descricao' => 'SAS/NSB']);
            DB::table('origems')->insert(['descricao' => 'SAS/NUT']);
            DB::table('origems')->insert(['descricao' => 'SAS/SUR/SVS']);
            DB::table('origems')->insert(['descricao' => 'SUGEST']);
            DB::table('origems')->insert(['descricao' => 'SUR']);
            DB::table('origems')->insert(['descricao' => 'SURGH']);
            DB::table('origems')->insert(['descricao' => 'SURGH/SAD']);
            DB::table('origems')->insert(['descricao' => 'SURGH/SAMU']);
            DB::table('origems')->insert(['descricao' => 'SURGH/SSA']);
            DB::table('origems')->insert(['descricao' => 'SVS']);
            DB::table('origems')->insert(['descricao' => 'SVS/DVAZ']);
            DB::table('origems')->insert(['descricao' => 'SVS/IMUNIZAÇÃO']);
            DB::table('origems')->insert(['descricao' => 'SVS/SVAZ']);
            DB::table('origems')->insert(['descricao' => 'TI']);
            DB::table('origems')->insert(['descricao' => 'TRANSPORTES']);


    }
}
