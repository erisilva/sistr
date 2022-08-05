<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Tr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PerpageSeeder::class);
        $this->call(PermissionSeeder::class);
        
        $this->call(SituacaosTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(ResponsavelsTableSeeder::class);
        $this->call(OrigensTableSeeder::class);
        $this->call(DeliberacaosTableSeeder::class);
        $this->call(ModalidadesTableSeeder::class);
        


        $this->call(acl::class);

        $trs = Tr::factory()->count(6)->create();

    }
}
