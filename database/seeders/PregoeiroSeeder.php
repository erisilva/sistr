<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PregoeiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('pregoeiros')->insert(['nome' => 'Não definido']);
    DB::table('pregoeiros')->insert(['nome' => 'FABIANA SILVA']);
    DB::table('pregoeiros')->insert(['nome' => 'MARCIO EUSTAQUIO']);
    DB::table('pregoeiros')->insert(['nome' => 'TASSIA RAFAELA']);

    }
}
