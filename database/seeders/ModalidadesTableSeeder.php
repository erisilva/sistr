<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ModalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modalidades')->insert(['descricao' => 'Não Definido']);
        DB::table('modalidades')->insert(['descricao' => 'DISPENSA']);
        DB::table('modalidades')->insert(['descricao' => 'PREGÃO']);
        DB::table('modalidades')->insert(['descricao' => 'ADESÃO RP']);
        DB::table('modalidades')->insert(['descricao' => 'CREDENCIAMENTO']);
        DB::table('modalidades')->insert(['descricao' => 'RATEIO']);
        DB::table('modalidades')->insert(['descricao' => 'INEXIGIBILIDADE']);
        DB::table('modalidades')->insert(['descricao' => 'ADESÃO']);

    }
}
