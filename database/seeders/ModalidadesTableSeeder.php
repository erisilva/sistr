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
        DB::table('modalidades')->insert(['descricao' => 'Não definido']);  
        DB::table('modalidades')->insert(['descricao' => 'Adesão a ARP']);
        DB::table('modalidades')->insert(['descricao' => 'Credenciamento']);
        DB::table('modalidades')->insert(['descricao' => 'Dispensa de Licitação']);
        DB::table('modalidades')->insert(['descricao' => 'Inexigibilidade']);
        DB::table('modalidades')->insert(['descricao' => 'Leilão']);
        DB::table('modalidades')->insert(['descricao' => 'Pregão Eletrônico']);

    }
}
