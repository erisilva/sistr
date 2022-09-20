<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permissões possíveis para o cadastro de operadores do sistema
        // user = operador
        DB::table('permissions')->insert([
            'name' => 'user-index',
            'description' => 'Lista de operadores',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user-create',
            'description' => 'Registrar novo operador',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user-edit',
            'description' => 'Alterar dados do operador',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user-delete',
            'description' => 'Excluir operador',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user-show',
            'description' => 'Mostrar dados do operador',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user-export',
            'description' => 'Exportação de dados dos operadores',
        ]);


        // permissões possíveis para o cadastro de perfis do sistema
        //role = perfil
        DB::table('permissions')->insert([
            'name' => 'role-index',
            'description' => 'Lista de perfis',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role-create',
            'description' => 'Registrar novo perfil',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role-edit',
            'description' => 'Alterar dados do perfil',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role-delete',
            'description' => 'Excluir perfil',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role-show',
            'description' => 'Alterar dados do perfil',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role-export',
            'description' => 'Exportação de dados dos perfis',
        ]);

        // permissões possíveis para o cadastro de permissões do sistema
        //permission = permissão de acesso
        DB::table('permissions')->insert([
            'name' => 'permission-index',
            'description' => 'Lista de permissões',
        ]);
        DB::table('permissions')->insert([
            'name' => 'permission-create',
            'description' => 'Registrar nova permissão',
        ]);
        DB::table('permissions')->insert([
            'name' => 'permission-edit',
            'description' => 'Alterar dados da permissão',
        ]);
        DB::table('permissions')->insert([
            'name' => 'permission-delete',
            'description' => 'Excluir permissão',
        ]);
        DB::table('permissions')->insert([
            'name' => 'permission-show',
            'description' => 'Mostrar dados da permissão',
        ]);
        DB::table('permissions')->insert([
            'name' => 'permission-export',
            'description' => 'Exportação de dados das permissões',
        ]);

        DB::table('permissions')->insert([
            'name' => 'situacao-index',
            'description' => 'Lista de situações',
        ]);
        DB::table('permissions')->insert([
            'name' => 'situacao-create',
            'description' => 'Registrar nova Situação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'situacao-edit',
            'description' => 'Alterar dados da Situação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'situacao-delete',
            'description' => 'Excluir Situação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'situacao-show',
            'description' => 'Mostrar dados da Situação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'situacao-export',
            'description' => 'Exportação de dados das situações',
        ]);

        DB::table('permissions')->insert([
            'name' => 'tipo-index',
            'description' => 'Lista de tipos',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tipo-create',
            'description' => 'Registrar nova Tipo',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tipo-edit',
            'description' => 'Alterar dados do Tipo',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tipo-delete',
            'description' => 'Excluir Tipo',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tipo-show',
            'description' => 'Mostrar dados do Tipo',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tipo-export',
            'description' => 'Exportação de dados dos tipos',
        ]);



        DB::table('permissions')->insert([
            'name' => 'responsavel-index',
            'description' => 'Lista de responsáveis',
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsavel-create',
            'description' => 'Registrar novo Responsável',
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsavel-edit',
            'description' => 'Alterar dados do Responsável',
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsavel-delete',
            'description' => 'Excluir Responsável',
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsavel-show',
            'description' => 'Mostrar dados do Responsável',
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsavel-export',
            'description' => 'Exportação de dados dos responsáveis',
        ]);


        DB::table('permissions')->insert([
            'name' => 'origem-index',
            'description' => 'Lista de origens',
        ]);
        DB::table('permissions')->insert([
            'name' => 'origem-create',
            'description' => 'Registrar nova origem',
        ]);
        DB::table('permissions')->insert([
            'name' => 'origem-edit',
            'description' => 'Alterar dados da origem',
        ]);
        DB::table('permissions')->insert([
            'name' => 'origem-delete',
            'description' => 'Excluir origem',
        ]);
        DB::table('permissions')->insert([
            'name' => 'origem-show',
            'description' => 'Mostrar dados da origem',
        ]);
        DB::table('permissions')->insert([
            'name' => 'origem-export',
            'description' => 'Exportação de dados das origens',
        ]);


        DB::table('permissions')->insert([
            'name' => 'deliberacao-index',
            'description' => 'Lista de deliberações',
        ]);
        DB::table('permissions')->insert([
            'name' => 'deliberacao-create',
            'description' => 'Registrar nova deliberação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'deliberacao-edit',
            'description' => 'Alterar dados da deliberação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'deliberacao-delete',
            'description' => 'Excluir deliberação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'deliberacao-show',
            'description' => 'Mostrar dados da deliberação',
        ]);
        DB::table('permissions')->insert([
            'name' => 'deliberacao-export',
            'description' => 'Exportação de dados das deliberações',
        ]);



        DB::table('permissions')->insert([
            'name' => 'modalidade-index',
            'description' => 'Lista de modalidades',
        ]);
        DB::table('permissions')->insert([
            'name' => 'modalidade-create',
            'description' => 'Registrar nova modalidade',
        ]);
        DB::table('permissions')->insert([
            'name' => 'modalidade-edit',
            'description' => 'Alterar dados da modalidade',
        ]);
        DB::table('permissions')->insert([
            'name' => 'modalidade-delete',
            'description' => 'Excluir modalidade',
        ]);
        DB::table('permissions')->insert([
            'name' => 'modalidade-show',
            'description' => 'Mostrar dados da modalidade',
        ]);
        DB::table('permissions')->insert([
            'name' => 'modalidade-export',
            'description' => 'Exportação de dados das modalidades',
        ]);

        DB::table('permissions')->insert([
            'name' => 'pregoeiro-index',
            'description' => 'Lista de pregoeiros',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pregoeiro-create',
            'description' => 'Registrar novo pregoeiro',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pregoeiro-edit',
            'description' => 'Alterar dados do pregoeiro',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pregoeiro-delete',
            'description' => 'Excluir pregoeiro',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pregoeiro-show',
            'description' => 'Mostrar dados da pregoeiro',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pregoeiro-export',
            'description' => 'Exportação de dados dos pregoeiros',
        ]);


        # TRS ------------------


        DB::table('permissions')->insert([
            'name' => 'tr-index',
            'description' => 'Lista de TRs',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-create',
            'description' => 'Registrar nova TR',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-edit',
            'description' => 'Alterar dados da TR',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-delete',
            'description' => 'Excluir TR',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-show',
            'description' => 'Mostrar dados da TR',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-export',
            'description' => 'Exportação de dados das TRs',
        ]);
        DB::table('permissions')->insert([
            'name' => 'tr-edit-numero-ano',
            'description' => 'Alteração do número/ano do TR',
        ]);

        # TR LOGS ------------------


        DB::table('permissions')->insert([
            'name' => 'trlog-index',
            'description' => 'Lista de Logs das TRs',
        ]);

    }
}
