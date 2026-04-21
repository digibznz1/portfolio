<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [];

        $role = Role::updateOrCreate([
                    'name' => 'super_admin',
                    'permissions' => $permissions,
                ]);

        Admin::updateOrCreate([
            'email'     => 'super_admin@app.com',
        ],[
            'name'      => 'name',
            'password'  => 'password',
            'status'    => 1,
            'role_id'   => $role?->id,
        ]);

        Admin::factory(4)->create();

    }//end of run

}//end of class