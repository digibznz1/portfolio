<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesPageSeeder extends Seeder
{
    public function run(): void
    {
        setting('services_page')->save([

            'badge' => [
                'ar' => 'قدراتنا',
                'en' => 'Our Capabilities',
            ],
            'title' => [
                'ar' => 'التميز الرقمي السيادي.',
                'en' => 'Sovereign Digital Excellence.',
            ],
            'description' => [
                'ar' => 'نسد الفجوة بين الموثوقية المؤسسية والتحول الرقمي السريع لقطاع B2B الخليجي من خلال تقنيات متقدمة مصممة خصيصًا.',
                'en' => 'We bridge the gap between institutional reliability and rapid digital transformation for the Gulf B2B sector through bespoke editorial-grade technology.',
            ],
            'image'         => null,
            'section_title' => [
                'ar' => 'الحلول الاستراتيجية',
                'en' => 'Strategic Solutions',
            ],
            'cta_title' => [
                'ar' => 'مستعد لتحويل بصمتك الرقمية؟',
                'en' => 'Ready to transform your digital footprint?',
            ],
            'cta_description' => [
                'ar' => 'شارك ديجي بيزنس لتطلق مستوى سيادياً من التكنولوجيا ودقة التصميم.',
                'en' => 'Partner with Digi Business to unlock sovereign-level technology and editorial design precision.',
            ],
            'cta_btn_primary' => [
                'ar' => 'احجز استشارة',
                'en' => 'Book a Consultation',
            ],
            'cta_btn_secondary' => [
                'ar' => 'اطلع على أعمالنا',
                'en' => 'View Case Studies',
            ],

        ]);
    }
}
