<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            LanguageSeeder::class,
            CategorySeeder::class,
            InitialEvaluationSeeder::class,
            SelfEvaluationSeeder::class,
            SelfEvaluationFileSeeder::class,
            OrganizationTypeSeeder::class,
            OrganizationSeeder::class,
        ]);

    }//end of run

}//en dof class