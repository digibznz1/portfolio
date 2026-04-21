<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'الامتثال والالتزام' => [
                'اللائحة الأساسية',
                'الجمعية العمومية',
                'الجمعية العمومية غير العادية',
                'مجلس الإدارة',
                'الرقابة',
                'السياسات',
                'الإدارة التنفيذية',
                'الفروع والمكاتب',
                'التقارير',
                'الأنظمة السارية',
                'الأنشطة والفعاليات',
                'الإيرادات والمصروفات',
                'الوثائق والسجلات',
                'اللجان',
                'في حال كان ايراد الجمعية 5 مليون فأكثر',
            ],

            'الشفافية والإفصاح' => [
                'اللوائح والانظمة',
                'بيانات القائمين على الجمعية',
                'بيانات الجمعية',
                'أهداف وبرامج الجمعية',
                'القوائم المالية',
                'نموذج الإفصاح',
            ],

            'السلامة المالية' => [
                'الهيكل التنظيمي',
                'تفعيل السياسات والإجراءات المالية',
                'التقارير',
                'الإجراءات المالية والمحاسبية',
                'قياس الأداء المالي',
                'الإقفال',
            ],
        ];

        foreach ($data as $parentName => $children) {

            $parent = Category::create([
                'name' => $parentName,
                'admin_id' => 1,
            ]);

            $children = array_unique($children);

            foreach ($children as $index => $childName) {

                if (empty(trim($childName))) {
                    continue;
                }

                Category::create([
                    'name' => trim($childName),
                    'parent_id' => $parent->id,
                    'index' => $index,
                    'admin_id' => 1,
                ]);
            }
        }
    }
}