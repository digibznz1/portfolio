<?php

namespace Database\Seeders;

use App\Enums\Admin\PageTypeEnum;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = \App\Models\Admin::first()?->id ?? 1;

        // ==================
        // Header
        // ==================
        $headerItems = [
            ['name' => ['ar' => 'الرئيسية',  'en' => 'Home'],        'link' => '/',         'index' => 1],
            ['name' => ['ar' => 'من نحن',    'en' => 'About Us'],    'link' => '/about',    'index' => 2],
            ['name' => ['ar' => 'خدماتنا',   'en' => 'Services'],    'link' => '#services', 'index' => 3],
            ['name' => ['ar' => 'لماذا نحن', 'en' => 'Why Us'],      'link' => '#why-us',   'index' => 4],
            ['name' => ['ar' => 'تواصل معنا','en' => 'Contact Us'],  'link' => '/contact',  'index' => 5],
        ];

        foreach ($headerItems as $item) {
            Menu::create([
                'name'     => $item['name'],
                'link'     => $item['link'],
                'index'    => $item['index'],
                'status'   => true,
                'type'     => PageTypeEnum::HEADER,
                'admin_id' => $adminId,
            ]);
        }

        // ==================
        // Footer Parents
        // ==================
        $footerGroups = [
            [
                'name'     => ['ar' => 'خدماتنا',    'en' => 'Expertise'],
                'index'    => 1,
                'children' => [
                    ['name' => ['ar' => 'تطوير المواقع والتطبيقات', 'en' => 'Web & App Development'], 'link' => '#', 'index' => 1],
                    ['name' => ['ar' => 'التسويق الرقمي',            'en' => 'Digital Marketing'],     'link' => '#', 'index' => 2],
                    ['name' => ['ar' => 'الهوية البصرية',            'en' => 'Branding'],              'link' => '#', 'index' => 3],
                    ['name' => ['ar' => 'صناعة المحتوى',             'en' => 'Content Creation'],      'link' => '#', 'index' => 4],
                ],
            ],
            [
                'name'     => ['ar' => 'المصادر',    'en' => 'Resources'],
                'index'    => 2,
                'children' => [
                    ['name' => ['ar' => 'رؤية السعودية 2030', 'en' => 'Saudi Vision 2030'],    'link' => '#', 'index' => 1],
                    ['name' => ['ar' => 'علاقات المستثمرين',  'en' => 'Investor Relations'],   'link' => '#', 'index' => 2],
                    ['name' => ['ar' => 'دراسات الحالة',      'en' => 'Case Studies'],          'link' => '#', 'index' => 3],
                    ['name' => ['ar' => 'الدعم الفني',        'en' => 'Contact Support'],       'link' => '/contact', 'index' => 4],
                ],
            ],
            [
                'name'     => ['ar' => 'قانوني',     'en' => 'Legal'],
                'index'    => 3,
                'children' => [
                    ['name' => ['ar' => 'سياسة الخصوصية',   'en' => 'Privacy Policy'],   'link' => '#', 'index' => 1],
                    ['name' => ['ar' => 'شروط الخدمة',      'en' => 'Terms of Service'], 'link' => '#', 'index' => 2],
                    ['name' => ['ar' => 'الامتثال',          'en' => 'Compliance'],       'link' => '#', 'index' => 3],
                ],
            ],
        ];

        foreach ($footerGroups as $group) {
            $parent = Menu::create([
                'name'      => $group['name'],
                'link'      => '#',
                'index'     => $group['index'],
                'status'    => true,
                'type'      => PageTypeEnum::FOOTER,
                'admin_id'  => $adminId,
                'parent_id' => null,
            ]);

            foreach ($group['children'] as $child) {
                Menu::create([
                    'name'      => $child['name'],
                    'link'      => $child['link'],
                    'index'     => $child['index'],
                    'status'    => true,
                    'type'      => PageTypeEnum::FOOTER,
                    'admin_id'  => $adminId,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
