<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PricingPageSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Settings =====
        setting('pricing_page')->save([

            'hero_badge' => [
                'ar' => 'استثمار استراتيجي',
                'en' => 'Strategic Investment',
            ],
            'hero_title' => [
                'ar' => 'نمو متدرج للمؤسسة الحديثة.',
                'en' => 'Scaled Growth for the Modern Enterprise.',
            ],
            'hero_description' => [
                'ar' => 'اختر الخطة التي تتوافق مع موقعك في السوق. من الشركات الناشئة إلى قادة السوق، نهندس سلطتك الرقمية.',
                'en' => 'Choose a plan that aligns with your market position. From emerging start-ups to dominant market leaders, we engineer digital authority.',
            ],

            'custom_badge' => [
                'ar' => 'النهج الحرفي',
                'en' => 'The Artisan Approach',
            ],
            'custom_title' => [
                'ar' => 'تحتاج مخططاً رقمياً مخصصاً؟',
                'en' => 'Need a bespoke digital blueprint?',
            ],
            'custom_description' => [
                'ar' => 'تتيح لك "الحزمة المخصصة" اختيار خدمات محددة. سواء كنت تحتاج إلى تحديث علامتك التجارية أو خارطة طريق رقمية متعددة السنوات، نبني وفق مواصفاتك.',
                'en' => 'Our "Custom Package" allows you to cherry-pick specific services. Whether you need a one-time brand overhaul or a multi-year digital roadmap, we build to your specifications.',
            ],
            'custom_image'    => null,
            'custom_btn_text' => [
                'ar' => 'طلب عرض سعر',
                'en' => 'Request Quote',
            ],
            'custom_chips' => [
                ['ar' => 'إعداد التحليلات',    'en' => 'Analytics Setup'],
                ['ar' => 'تطوير تطبيقات',      'en' => 'Native App Dev'],
                ['ar' => 'تكامل الذكاء الاصطناعي', 'en' => 'AI Integration'],
                ['ar' => 'إدارة المؤثرين',     'en' => 'Influencer Management'],
            ],
            'custom_plan_title' => [
                'ar' => 'صمم خطتك',
                'en' => 'Design Your Plan',
            ],
            'custom_plan_items' => [
                ['ar' => 'إنتاج الفيديو', 'en' => 'Video Production'],
                ['ar' => 'تكامل CRM',     'en' => 'CRM Integration'],
                ['ar' => 'كتابة المحتوى', 'en' => 'Copywriting'],
            ],

            'comparison_title' => [
                'ar' => 'الميزة التنفيذية',
                'en' => 'The Executive Advantage',
            ],
            'comparison_features' => [
                [
                    'name'       => ['ar' => 'مدير حساب مخصص',       'en' => 'Dedicated Account Manager'],
                    'startup'    => false,
                    'growth'     => true,
                    'enterprise' => true,
                ],
                [
                    'name'       => ['ar' => 'دعم أولوية 24/7',        'en' => '24/7 Priority Support'],
                    'startup'    => false,
                    'growth'     => false,
                    'enterprise' => true,
                ],
                [
                    'name'       => ['ar' => 'مراجعات استراتيجية ربع سنوية', 'en' => 'Quarterly Strategy Audits'],
                    'startup'    => true,
                    'growth'     => true,
                    'enterprise' => true,
                ],
                [
                    'name'       => ['ar' => 'وصول للوحة تحكم مخصصة', 'en' => 'Custom Dashboard Access'],
                    'startup'    => false,
                    'growth'     => true,
                    'enterprise' => true,
                ],
            ],

        ]);

        // ===== Packages =====
        Package::truncate();

        $packages = [
            [
                'name'         => ['ar' => 'المبتدئ',   'en' => 'Start-Up'],
                'subtitle'     => ['ar' => 'بناء الأساس الرقمي.',     'en' => 'Laying the digital foundation.'],
                'price'        => '4,500',
                'price_unit'   => ['ar' => '/شهر',  'en' => '/mo'],
                'features'     => [
                    ['ar' => 'تصميم الهوية البصرية',       'en' => 'Visual Identity Design'],
                    ['ar' => 'استراتيجية التواصل الاجتماعي','en' => 'Social Media Strategy'],
                    ['ar' => 'إنتاج المحتوى (4/شهر)',       'en' => 'Content Production (4/mo)'],
                ],
                'button_text'  => ['ar' => 'اختر المبتدئ',   'en' => 'Select Start-Up'],
                'button_style' => 'outline',
                'is_featured'  => false,
                'index'        => 1,
                'status'       => true,
            ],
            [
                'name'         => ['ar' => 'النمو',     'en' => 'Growth'],
                'subtitle'     => ['ar' => 'تسريع الحضور في السوق.', 'en' => 'Accelerating market presence.'],
                'price'        => '8,900',
                'price_unit'   => ['ar' => '/شهر',  'en' => '/mo'],
                'features'     => [
                    ['ar' => 'كل ما في المبتدئ',             'en' => 'Everything in Start-Up'],
                    ['ar' => 'إعلانات الأداء (SEM)',          'en' => 'Performance Ads (SEM)'],
                    ['ar' => 'تدقيق تحسين محركات البحث',     'en' => 'Technical SEO Audit'],
                    ['ar' => 'تحسين معدل التحويل',           'en' => 'Conversion Rate Optimization'],
                ],
                'button_text'  => ['ar' => 'الترقية إلى النمو', 'en' => 'Upgrade to Growth'],
                'button_style' => 'filled',
                'is_featured'  => true,
                'index'        => 2,
                'status'       => true,
            ],
            [
                'name'         => ['ar' => 'المؤسسات', 'en' => 'Enterprise'],
                'subtitle'     => ['ar' => 'تحول شامل متكامل.',       'en' => 'Full spectrum transformation.'],
                'price'        => '15,500',
                'price_unit'   => ['ar' => '/شهر',  'en' => '/mo'],
                'features'     => [
                    ['ar' => 'كل ما في النمو',               'en' => 'Everything in Growth'],
                    ['ar' => 'استراتيجية تسويق 360',         'en' => '360 Marketing Strategy'],
                    ['ar' => 'تطوير ويب مخصص',               'en' => 'Custom Web Development'],
                    ['ar' => 'العلاقات العامة والإعلام',     'en' => 'PR & Media Relations'],
                ],
                'button_text'  => ['ar' => 'تواصل للمؤسسات', 'en' => 'Contact Enterprise'],
                'button_style' => 'outline',
                'is_featured'  => false,
                'index'        => 3,
                'status'       => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
