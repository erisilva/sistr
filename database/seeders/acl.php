<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;


use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class acl extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // apaga todas as tabelas de relacionamento
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();

        // recebe os operadores principais principais do sistema
        // utilizo o termo operador em vez de usuário por esse
        // significar usuário do SUS, ou usuário do plano, em vez de pessoa ou cliente
        $administrador = User::where('email','=','adm@mail.com')->get()->first();
        $gerente = User::where('email','=','gerente@mail.com')->get()->first();
        $operador = User::where('email','=','operador@mail.com')->get()->first();
        $leitor = User::where('email','=','leitor@mail.com')->get()->first();

        // recebi os perfis
        $administrador_perfil = Role::where('name', '=', 'admin')->get()->first();
        $gerente_perfil = Role::where('name', '=', 'gerente')->get()->first();
        $operador_perfil = Role::where('name', '=', 'operador')->get()->first();
        $leitor_perfil = Role::where('name', '=', 'leitor')->get()->first();

        // salva os relacionamentos entre operador e perfil
        $administrador->roles()->attach($administrador_perfil);
        $gerente->roles()->attach($gerente_perfil);
        $operador->roles()->attach($operador_perfil);
        $leitor->roles()->attach($leitor_perfil);

        // recebi as permissoes
        // para operadores
        $user_index = Permission::where('name', '=', 'user-index')->get()->first();       
        $user_create = Permission::where('name', '=', 'user-create')->get()->first();      
        $user_edit = Permission::where('name', '=', 'user-edit')->get()->first();        
        $user_delete = Permission::where('name', '=', 'user-delete')->get()->first();      
        $user_show = Permission::where('name', '=', 'user-show')->get()->first();        
        $user_export = Permission::where('name', '=', 'user-export')->get()->first();      
        // para perfis
        $role_index = Permission::where('name', '=', 'role-index')->get()->first();       
        $role_create = Permission::where('name', '=', 'role-create')->get()->first();      
        $role_edit = Permission::where('name', '=', 'role-edit')->get()->first();        
        $role_delete = Permission::where('name', '=', 'role-delete')->get()->first();      
        $role_show = Permission::where('name', '=', 'role-show')->get()->first();        
        $role_export = Permission::where('name', '=', 'role-export')->get()->first();      
        // para permissões
        $permission_index = Permission::where('name', '=', 'permission-index')->get()->first(); 
        $permission_create = Permission::where('name', '=', 'permission-create')->get()->first();
        $permission_edit = Permission::where('name', '=', 'permission-edit')->get()->first();  
        $permission_delete = Permission::where('name', '=', 'permission-delete')->get()->first();
        $permission_show = Permission::where('name', '=', 'permission-show')->get()->first();  
        $permission_export = Permission::where('name', '=', 'permission-export')->get()->first();
        // para permissões
        $situacao_index = Permission::where('name', '=', 'situacao-index')->get()->first(); 
        $situacao_create = Permission::where('name', '=', 'situacao-create')->get()->first();
        $situacao_edit = Permission::where('name', '=', 'situacao-edit')->get()->first();  
        $situacao_delete = Permission::where('name', '=', 'situacao-delete')->get()->first();
        $situacao_show = Permission::where('name', '=', 'situacao-show')->get()->first();  
        $situacao_export = Permission::where('name', '=', 'situacao-export')->get()->first();
        // para tipo
        $tipo_index = Permission::where('name', '=', 'tipo-index')->get()->first(); 
        $tipo_create = Permission::where('name', '=', 'tipo-create')->get()->first();
        $tipo_edit = Permission::where('name', '=', 'tipo-edit')->get()->first();  
        $tipo_delete = Permission::where('name', '=', 'tipo-delete')->get()->first();
        $tipo_show = Permission::where('name', '=', 'tipo-show')->get()->first();  
        $tipo_export = Permission::where('name', '=', 'tipo-export')->get()->first();
        // para responsavel
        $responsavel_index = Permission::where('name', '=', 'responsavel-index')->get()->first(); 
        $responsavel_create = Permission::where('name', '=', 'responsavel-create')->get()->first();
        $responsavel_edit = Permission::where('name', '=', 'responsavel-edit')->get()->first();  
        $responsavel_delete = Permission::where('name', '=', 'responsavel-delete')->get()->first();
        $responsavel_show = Permission::where('name', '=', 'responsavel-show')->get()->first();  
        $responsavel_export = Permission::where('name', '=', 'responsavel-export')->get()->first();
        // para origem
        $origem_index = Permission::where('name', '=', 'origem-index')->get()->first(); 
        $origem_create = Permission::where('name', '=', 'origem-create')->get()->first();
        $origem_edit = Permission::where('name', '=', 'origem-edit')->get()->first();  
        $origem_delete = Permission::where('name', '=', 'origem-delete')->get()->first();
        $origem_show = Permission::where('name', '=', 'origem-show')->get()->first();  
        $origem_export = Permission::where('name', '=', 'origem-export')->get()->first();
        // para deliberacao
        $deliberacao_index = Permission::where('name', '=', 'deliberacao-index')->get()->first(); 
        $deliberacao_create = Permission::where('name', '=', 'deliberacao-create')->get()->first();
        $deliberacao_edit = Permission::where('name', '=', 'deliberacao-edit')->get()->first();  
        $deliberacao_delete = Permission::where('name', '=', 'deliberacao-delete')->get()->first();
        $deliberacao_show = Permission::where('name', '=', 'deliberacao-show')->get()->first();  
        $deliberacao_export = Permission::where('name', '=', 'deliberacao-export')->get()->first();
        // para modalidade
        $modalidade_index = Permission::where('name', '=', 'modalidade-index')->get()->first(); 
        $modalidade_create = Permission::where('name', '=', 'modalidade-create')->get()->first();
        $modalidade_edit = Permission::where('name', '=', 'modalidade-edit')->get()->first();  
        $modalidade_delete = Permission::where('name', '=', 'modalidade-delete')->get()->first();
        $modalidade_show = Permission::where('name', '=', 'modalidade-show')->get()->first();  
        $modalidade_export = Permission::where('name', '=', 'modalidade-export')->get()->first();
        // para pregoeiro
        $pregoeiro_index = Permission::where('name', '=', 'pregoeiro-index')->get()->first(); 
        $pregoeiro_create = Permission::where('name', '=', 'pregoeiro-create')->get()->first();
        $pregoeiro_edit = Permission::where('name', '=', 'pregoeiro-edit')->get()->first();  
        $pregoeiro_delete = Permission::where('name', '=', 'pregoeiro-delete')->get()->first();
        $pregoeiro_show = Permission::where('name', '=', 'pregoeiro-show')->get()->first();  
        $pregoeiro_export = Permission::where('name', '=', 'pregoeiro-export')->get()->first();
        // para TRs -------
        $tr_index = Permission::where('name', '=', 'tr-index')->get()->first(); 
        $tr_create = Permission::where('name', '=', 'tr-create')->get()->first();
        $tr_edit = Permission::where('name', '=', 'tr-edit')->get()->first();  
        $tr_delete = Permission::where('name', '=', 'tr-delete')->get()->first();
        $tr_show = Permission::where('name', '=', 'tr-show')->get()->first();  
        $tr_export = Permission::where('name', '=', 'tr-export')->get()->first();




        // salva os relacionamentos entre perfil e suas permissões
        
        // o administrador tem acesso total ao sistema, incluindo
        // configurações avançadas de desenvolvimento
        $administrador_perfil->permissions()->attach($user_index);
        $administrador_perfil->permissions()->attach($user_create);
        $administrador_perfil->permissions()->attach($user_edit);
        $administrador_perfil->permissions()->attach($user_delete);
        $administrador_perfil->permissions()->attach($user_show);
        $administrador_perfil->permissions()->attach($user_export);
        $administrador_perfil->permissions()->attach($role_index);
        $administrador_perfil->permissions()->attach($role_create);
        $administrador_perfil->permissions()->attach($role_edit);
        $administrador_perfil->permissions()->attach($role_delete);
        $administrador_perfil->permissions()->attach($role_show);
        $administrador_perfil->permissions()->attach($role_export);
        $administrador_perfil->permissions()->attach($permission_index);
        $administrador_perfil->permissions()->attach($permission_create);
        $administrador_perfil->permissions()->attach($permission_edit);
        $administrador_perfil->permissions()->attach($permission_delete);
        $administrador_perfil->permissions()->attach($permission_show);
        $administrador_perfil->permissions()->attach($permission_export);
        #situacao
        $administrador_perfil->permissions()->attach($situacao_index);
        $administrador_perfil->permissions()->attach($situacao_create);
        $administrador_perfil->permissions()->attach($situacao_edit);
        $administrador_perfil->permissions()->attach($situacao_delete);
        $administrador_perfil->permissions()->attach($situacao_show);
        $administrador_perfil->permissions()->attach($situacao_export);
        #tipo
        $administrador_perfil->permissions()->attach($tipo_index);
        $administrador_perfil->permissions()->attach($tipo_create);
        $administrador_perfil->permissions()->attach($tipo_edit);
        $administrador_perfil->permissions()->attach($tipo_delete);
        $administrador_perfil->permissions()->attach($tipo_show);
        $administrador_perfil->permissions()->attach($tipo_export);
        #responsavel
        $administrador_perfil->permissions()->attach($responsavel_index);
        $administrador_perfil->permissions()->attach($responsavel_create);
        $administrador_perfil->permissions()->attach($responsavel_edit);
        $administrador_perfil->permissions()->attach($responsavel_delete);
        $administrador_perfil->permissions()->attach($responsavel_show);
        $administrador_perfil->permissions()->attach($responsavel_export);
        #origem
        $administrador_perfil->permissions()->attach($origem_index);
        $administrador_perfil->permissions()->attach($origem_create);
        $administrador_perfil->permissions()->attach($origem_edit);
        $administrador_perfil->permissions()->attach($origem_delete);
        $administrador_perfil->permissions()->attach($origem_show);
        $administrador_perfil->permissions()->attach($origem_export);
        #deliberacao
        $administrador_perfil->permissions()->attach($deliberacao_index);
        $administrador_perfil->permissions()->attach($deliberacao_create);
        $administrador_perfil->permissions()->attach($deliberacao_edit);
        $administrador_perfil->permissions()->attach($deliberacao_delete);
        $administrador_perfil->permissions()->attach($deliberacao_show);
        $administrador_perfil->permissions()->attach($deliberacao_export);
        #modalidade
        $administrador_perfil->permissions()->attach($modalidade_index);
        $administrador_perfil->permissions()->attach($modalidade_create);
        $administrador_perfil->permissions()->attach($modalidade_edit);
        $administrador_perfil->permissions()->attach($modalidade_delete);
        $administrador_perfil->permissions()->attach($modalidade_show);
        $administrador_perfil->permissions()->attach($modalidade_export);
        #pregoeiro
        $administrador_perfil->permissions()->attach($pregoeiro_index);
        $administrador_perfil->permissions()->attach($pregoeiro_create);
        $administrador_perfil->permissions()->attach($pregoeiro_edit);
        $administrador_perfil->permissions()->attach($pregoeiro_delete);
        $administrador_perfil->permissions()->attach($pregoeiro_show);
        $administrador_perfil->permissions()->attach($pregoeiro_export);
        #tr
        $administrador_perfil->permissions()->attach($tr_index);
        $administrador_perfil->permissions()->attach($tr_create);
        $administrador_perfil->permissions()->attach($tr_edit);
        $administrador_perfil->permissions()->attach($tr_delete);
        $administrador_perfil->permissions()->attach($tr_show);
        $administrador_perfil->permissions()->attach($tr_export);


        // o gerente (diretor) pode gerenciar os operadores do sistema
        $gerente_perfil->permissions()->attach($user_index);
        $gerente_perfil->permissions()->attach($user_create);
        $gerente_perfil->permissions()->attach($user_edit);
        $gerente_perfil->permissions()->attach($user_show);
        $gerente_perfil->permissions()->attach($user_export);
        #situacao
        $gerente_perfil->permissions()->attach($situacao_index);
        $gerente_perfil->permissions()->attach($situacao_create);
        $gerente_perfil->permissions()->attach($situacao_edit);
        $gerente_perfil->permissions()->attach($situacao_show);
        $gerente_perfil->permissions()->attach($situacao_export);
        #tipo
        $gerente_perfil->permissions()->attach($tipo_index);
        $gerente_perfil->permissions()->attach($tipo_create);
        $gerente_perfil->permissions()->attach($tipo_edit);
        $gerente_perfil->permissions()->attach($tipo_show);
        $gerente_perfil->permissions()->attach($tipo_export);
        #responsavel
        $gerente_perfil->permissions()->attach($responsavel_index);
        $gerente_perfil->permissions()->attach($responsavel_create);
        $gerente_perfil->permissions()->attach($responsavel_edit);
        $gerente_perfil->permissions()->attach($responsavel_show);
        $gerente_perfil->permissions()->attach($responsavel_export);
        #origem
        $gerente_perfil->permissions()->attach($origem_index);
        $gerente_perfil->permissions()->attach($origem_create);
        $gerente_perfil->permissions()->attach($origem_edit);
        $gerente_perfil->permissions()->attach($origem_show);
        $gerente_perfil->permissions()->attach($origem_export);
        #deliberacao
        $gerente_perfil->permissions()->attach($deliberacao_index);
        $gerente_perfil->permissions()->attach($deliberacao_create);
        $gerente_perfil->permissions()->attach($deliberacao_edit);
        $gerente_perfil->permissions()->attach($deliberacao_show);
        $gerente_perfil->permissions()->attach($deliberacao_export);
        #modalidade
        $gerente_perfil->permissions()->attach($modalidade_index);
        $gerente_perfil->permissions()->attach($modalidade_create);
        $gerente_perfil->permissions()->attach($modalidade_edit);
        $gerente_perfil->permissions()->attach($modalidade_show);
        $gerente_perfil->permissions()->attach($modalidade_export);
        #pregoeiro
        $gerente_perfil->permissions()->attach($pregoeiro_index);
        $gerente_perfil->permissions()->attach($pregoeiro_create);
        $gerente_perfil->permissions()->attach($pregoeiro_edit);
        $gerente_perfil->permissions()->attach($pregoeiro_show);
        $gerente_perfil->permissions()->attach($pregoeiro_export);
        #modalidade
        $gerente_perfil->permissions()->attach($tr_index);
        $gerente_perfil->permissions()->attach($tr_create);
        $gerente_perfil->permissions()->attach($tr_edit);
        $gerente_perfil->permissions()->attach($tr_show);
        $gerente_perfil->permissions()->attach($tr_export);


        // o operador é o nível de operação do sistema não pode criar
        // outros operadores
        $operador_perfil->permissions()->attach($user_index);
        $operador_perfil->permissions()->attach($user_show);
        $operador_perfil->permissions()->attach($user_export);
        #situacao
        $operador_perfil->permissions()->attach($situacao_index);
        $operador_perfil->permissions()->attach($situacao_show);
        $operador_perfil->permissions()->attach($situacao_export);
        #tipos
        $operador_perfil->permissions()->attach($tipo_index);
        $operador_perfil->permissions()->attach($tipo_show);
        $operador_perfil->permissions()->attach($tipo_export);
        #responsavel
        $operador_perfil->permissions()->attach($responsavel_index);
        $operador_perfil->permissions()->attach($responsavel_show);
        $operador_perfil->permissions()->attach($responsavel_export);
        #origem
        $operador_perfil->permissions()->attach($origem_index);
        $operador_perfil->permissions()->attach($origem_show);
        $operador_perfil->permissions()->attach($origem_export);
        #deliberacao
        $operador_perfil->permissions()->attach($deliberacao_index);
        $operador_perfil->permissions()->attach($deliberacao_show);
        $operador_perfil->permissions()->attach($deliberacao_export);
        #modalidade
        $operador_perfil->permissions()->attach($modalidade_index);
        $operador_perfil->permissions()->attach($modalidade_show);
        $operador_perfil->permissions()->attach($modalidade_export);
        #pregoeiro
        $operador_perfil->permissions()->attach($pregoeiro_index);
        $operador_perfil->permissions()->attach($pregoeiro_show);
        $operador_perfil->permissions()->attach($pregoeiro_export);
        #tr
        $operador_perfil->permissions()->attach($tr_index);
        $operador_perfil->permissions()->attach($tr_show);
        $operador_perfil->permissions()->attach($tr_export);


        // leitura é um tipo de operador que só pode ler
        // os dados na tela
        $leitor_perfil->permissions()->attach($user_index);
        $leitor_perfil->permissions()->attach($user_show);
        #situacao
        $leitor_perfil->permissions()->attach($situacao_index);
        $leitor_perfil->permissions()->attach($situacao_show);
        #tipos
        $leitor_perfil->permissions()->attach($tipo_index);
        $leitor_perfil->permissions()->attach($tipo_show);
        #responsavel
        $leitor_perfil->permissions()->attach($responsavel_index);
        $leitor_perfil->permissions()->attach($responsavel_show);
        #origem
        $leitor_perfil->permissions()->attach($origem_index);
        $leitor_perfil->permissions()->attach($origem_show);
        #deliberacao
        $leitor_perfil->permissions()->attach($deliberacao_index);
        $leitor_perfil->permissions()->attach($deliberacao_show);
        #modalidade
        $leitor_perfil->permissions()->attach($modalidade_index);
        $leitor_perfil->permissions()->attach($modalidade_show);
        #pregoeiro
        $leitor_perfil->permissions()->attach($pregoeiro_index);
        $leitor_perfil->permissions()->attach($pregoeiro_show);
        #tr
        $leitor_perfil->permissions()->attach($tr_index);
        $leitor_perfil->permissions()->attach($tr_show);


    }
}
