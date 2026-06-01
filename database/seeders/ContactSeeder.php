<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        setting('contact')->save([
            'badge'                => [
                'ar' => 'شراكة استراتيجية',
                'en' => 'Strategic Partnership',
            ],
            'title'                => [
                'ar' => 'تواصل مع خبرائنا السياديين.',
                'en' => 'Connect with Sovereign Expertise.',
            ],
            'description'          => [
                'ar' => 'سواء كنت تبحث عن استفسار سريع أو عرض تحويل رقمي شامل، فريقنا في جدة مستعد لتسريع رحلتك.',
                'en' => 'Whether you\'re looking for a quick inquiry or a comprehensive digital transformation quote, our team in Jeddah is ready to accelerate your journey.',
            ],
            'headquarters'         => [
                'ar' => 'المقر الرئيسي: جدة، المملكة العربية السعودية',
                'en' => 'Headquarters: Jeddah, KSA',
            ],
            'consultation_title'   => [
                'ar' => 'استشارة 15 دقيقة',
                'en' => '15-Minute Consultation',
            ],
            'address'              => [
                'ar' => 'طريق الملك عبدالعزيز، جدة',
                'en' => 'King Abdulaziz Rd, Jeddah',
            ],
            'office_image'         => null,
            'time_slots'           => ['09:00 AM', '10:30 AM', '01:15 PM', '03:45 PM'],
        ]);
    }
}
