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
            ServiceSeeder::class,
            HeroSeeder::class,
            AboutSeeder::class,
            WhyUsSeeder::class,
            CtaSeeder::class,
            GeneralSeeder::class,
            MenuSeeder::class,
            ContactSeeder::class,
        ]);

    }//end of run

}//en dof class