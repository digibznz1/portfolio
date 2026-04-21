<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
//use App\Models\Admin;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'      => 'العربية',
                'dir'       => 'RTL',
                'code'      => 'ar',
                'default'   => 1,
                'status'    => 1,
                'index'     => 1,
                'created_at'=> now(),
                //'admin_id'  => Admin::first()?->id,
            ],
            [
                'name'      => 'English',
                'dir'       => 'LTR',
                'code'      => 'en',
                'default'   => 0,
                'status'    => 1,
                'index'     => 2,
                'created_at'=> now(),
                //'admin_id'  => Admin::first()?->id,
            ],

        ];

        Language::insert($data);

    }//end of run
    
}//end of class