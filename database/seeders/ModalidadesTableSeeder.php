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
        DB::table('modalidades')->insert(['descricao' => 'ADESAO ARP']);
        DB::table('modalidades')->insert(['descricao' => 'CONCORRENCIA']);
        DB::table('modalidades')->insert(['descricao' => 'CONCURSO']);
        DB::table('modalidades')->insert(['descricao' => 'DIALOGO COMPETITIVO']);
        DB::table('modalidades')->insert(['descricao' => 'DISPENSA']);
        DB::table('modalidades')->insert(['descricao' => 'INEXIGIBILIDADE']);
        DB::table('modalidades')->insert(['descricao' => 'LEILAO']);
        DB::table('modalidades')->insert(['descricao' => 'PREGAO ELETRONICO']);
        DB::table('modalidades')->insert(['descricao' => 'PREGAO PRESENCIAL']);

    }
}
