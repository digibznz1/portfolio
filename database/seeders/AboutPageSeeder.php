<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Settings =====
        setting('about_page')->save([

            // Hero
            'hero_badge' => [
                'ar' => 'تأسست في جدة',
                'en' => 'Established in Jeddah',
            ],
            'hero_title' => [
                'ar' => 'الذراع الرقمي للطموح السعودي.',
                'en' => 'The Digital Arm of Saudi Ambition.',
            ],
            'hero_description' => [
                'ar' => 'تأسست لتكون المحرك للتحول الرقمي، تُمكّن ديجي بيزنس المؤسسات السعودية بأحدث التقنيات والخبرة المحلية.',
                'en' => 'Founded to be the catalyst for digital transformation, Digi Business empowers Saudi enterprises with cutting-edge technology and localized expertise.',
            ],
            'hero_image'            => null,
            'hero_stat_number'      => ['ar' => '200%', 'en' => '200%'],
            'hero_stat_label'       => ['ar' => 'متوسط النمو السنوي', 'en' => 'Average Annual Growth'],
            'hero_stat_description' => [
                'ar' => 'تمكين الشركاء في المملكة من التوسع بسرعات غير مسبوقة من خلال التصميم الرقمي السيادي.',
                'en' => 'Empowering partners across the Kingdom to scale at unprecedented velocities through Sovereign Kinetic design.',
            ],

            // Vision
            'vision_title' => [
                'ar' => 'رؤيتنا',
                'en' => 'Our Vision',
            ],
            'vision_description' => [
                'ar' => 'أن نكون المهندس الرئيسي للاقتصاد الرقمي السعودي، بما يتوافق مع الأهداف الطموحة لرؤية 2030.',
                'en' => 'To be the primary architect of the Saudi digital economy, aligning every innovation with the visionary goals of Saudi Vision 2030.',
            ],

            // Mission
            'mission_title' => [
                'ar' => 'مهمتنا',
                'en' => 'Our Mission',
            ],
            'mission_description' => [
                'ar' => 'نقدم حلولاً رقمية سيادية تجمع بين معايير التكنولوجيا العالمية والذكاء الثقافي المحلي، لضمان قدرة كل مؤسسة سعودية على المنافسة في الساحة الدولية.',
                'en' => 'We provide sovereign digital solutions that merge global technology standards with localized cultural intelligence, ensuring every Saudi enterprise can compete on the world stage.',
            ],
            'mission_cta' => [
                'ar' => 'اقرأ بياننا',
                'en' => 'Read our Manifesto',
            ],

            // Leadership
            'leadership_title' => [
                'ar' => 'قيادتنا',
                'en' => 'Our Leadership',
            ],
            'leadership_subtitle' => [
                'ar' => 'مزيج من الخبرة الدولية والتراث المحلي يقود توجهنا الاستراتيجي.',
                'en' => 'A fusion of international experience and local heritage drives our strategic direction.',
            ],

            // CTA
            'cta_title' => [
                'ar' => 'مستعد لإعادة تعريف آفاقك الرقمية؟',
                'en' => 'Ready to redefine your digital horizon?',
            ],
            'cta_btn_primary' => [
                'ar' => 'تواصل مع خبير',
                'en' => 'Connect with an Expert',
            ],
            'cta_btn_secondary' => [
                'ar' => 'حلولنا',
                'en' => 'Our Solutions',
            ],

        ]);

        // ===== Team Members =====
        Member::truncate();

        $members = [
            [
                'name'     => ['ar' => 'عمر السيد',      'en' => 'Omar Al-Sayed'],
                'position' => ['ar' => 'المؤسس والرئيس التنفيذي', 'en' => 'Founder & Chief Executive Officer'],
                'bio'      => [
                    'ar' => 'بخبرة تمتد لأكثر من 20 عامًا في البنية التحتية الرقمية، يقود عمر رؤيتنا لتوطين الحلول التقنية المتطورة.',
                    'en' => 'With over 20 years in digital infrastructure, Omar leads our vision of domesticating high-tech solutions.',
                ],
                'image'  => null,
                'index'  => 1,
                'status' => true,
            ],
            [
                'name'     => ['ar' => 'سارة جنكينز',    'en' => 'Sarah Jenkins'],
                'position' => ['ar' => 'رئيسة التقنية',  'en' => 'Chief Technology Officer'],
                'bio'      => [
                    'ar' => 'قادمة من وادي السيليكون، تقود سارة الابتكار التقني واستراتيجيات السحابة الأصلية.',
                    'en' => 'Former Silicon Valley veteran, Sarah spearheads our technical innovation and cloud-native strategies.',
                ],
                'image'  => null,
                'index'  => 2,
                'status' => true,
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
