<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ResponsavelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
DB::table('responsavels')->insert(['nome' => 'Não definido']);        
DB::table('responsavels')->insert(['nome' => 'ANA PAULA MARIANI']);
DB::table('responsavels')->insert(['nome' => 'BARBARA PEREIRA']);
DB::table('responsavels')->insert(['nome' => 'CECILIA BOAVENTURA']);
DB::table('responsavels')->insert(['nome' => 'CLEONICE NEVES']);
DB::table('responsavels')->insert(['nome' => 'COTADO NA ORIGEM']);
DB::table('responsavels')->insert(['nome' => 'ELIANE FERNANDES']);
DB::table('responsavels')->insert(['nome' => 'GRAZIELY EDUARDO']);
DB::table('responsavels')->insert(['nome' => 'MARCOS COSTA']);
DB::table('responsavels')->insert(['nome' => 'MATHEUS SILVEIRA']);
DB::table('responsavels')->insert(['nome' => 'MICHELE SOUZA']);
DB::table('responsavels')->insert(['nome' => 'MILTON CARVALHO']);
DB::table('responsavels')->insert(['nome' => 'SANDRA ZARAMELA']);

    }
}
