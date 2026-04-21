<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'جمعية', 'status' => 1],
            ['name' => 'مؤسسة', 'status' => 1],
            ['name' => 'وقف', 'status' => 1],
        ];

        OrganizationType::insert($items);

    }//end of run

}//end of sedder