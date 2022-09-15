<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DeliberacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliberacaos')->insert(['descricao' => 'Não definido']);
        DB::table('deliberacaos')->insert(['descricao' => 'APROVADO']);
        DB::table('deliberacaos')->insert(['descricao' => 'DEVOLVIDO']);
        DB::table('deliberacaos')->insert(['descricao' => 'INDEFERIDO']);

    }
}
