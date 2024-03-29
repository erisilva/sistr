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
                DB::table('responsavels')->insert(['nome' => 'LUIZ ADOLFO']);
                DB::table('responsavels')->insert(['nome' => 'CECÍLIA']);
                DB::table('responsavels')->insert(['nome' => 'JOÃO PEDRO']);
                DB::table('responsavels')->insert(['nome' => 'SANDRA']);
                DB::table('responsavels')->insert(['nome' => 'ORGIEM']);
                DB::table('responsavels')->insert(['nome' => 'MATHEUS']);
                DB::table('responsavels')->insert(['nome' => 'CLEONICE']);
                DB::table('responsavels')->insert(['nome' => 'ORIGEM']);
                DB::table('responsavels')->insert(['nome' => 'ANA PAULA']);
                DB::table('responsavels')->insert(['nome' => 'ELIANE']);
                DB::table('responsavels')->insert(['nome' => 'MICHELE']);
                DB::table('responsavels')->insert(['nome' => 'LUIS ADOLFO']);
                DB::table('responsavels')->insert(['nome' => 'GRAZIELY']);
                DB::table('responsavels')->insert(['nome' => 'AGLAIA']);
                DB::table('responsavels')->insert(['nome' => 'WLADINEY']);
                DB::table('responsavels')->insert(['nome' => 'MARCOS']);
                DB::table('responsavels')->insert(['nome' => 'MILTON']);
                DB::table('responsavels')->insert(['nome' => 'CECILIA']);

    }
}
