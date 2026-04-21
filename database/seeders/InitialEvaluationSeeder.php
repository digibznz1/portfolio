<?php

namespace Database\Seeders;

use App\Models\InitialEvaluation;
use Illuminate\Database\Seeder;

class InitialEvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'question' => 'هل تم تعديل اللائحة الأساسية خلال عام 2025؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 1,
            ],
            [
                'question' => 'هل عقدت اجتماعات الجمعية العمومية غير العادية في 2025 ؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 1,
            ],
            [
                'question' => 'هل انتخاباب المجلس تمت في 2025 أو بداية 2026',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 1,
            ],
            [
                'question' => 'هل لدى الجمعية فروع',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 1,
            ],
            [
                'question' => 'هل نفذت الجمعية برامج خارج نطاقها الإداري؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 2,
            ],
            [
                'question' => 'هل نفذت الجمعية أنشطة خارج المملكة؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 2,
            ],
            [
                'question' => 'هل لدى الجمعية لجان ؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 2,
            ],
            [
                'question' => 'هل ايراد الجمعية 5 مليون فأكثر',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 3,
            ],
            [
                'question' => 'هل لدى الجمعية استثمارات ؟',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 3,
            ],
            [
                'question' => 'هل لدى الجمعية فرع الكتروني',
                'answer' => 1,
                'admin_id' => 1,
                'category_id' => random_int(4, 7),
                'organization_type_id' => 3,
            ],
        ];

        InitialEvaluation::insert($items);
    }
}
