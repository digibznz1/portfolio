<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::updateOrCreate([
            'email'     => 'organization@app.com',
        ],[
            'name'      => 'جمعية السكري السعودية الخيرية',
            'password'  => 'password',
            'status'    => 1,
        ]);

        Organization::factory(15)->create();
    }
}