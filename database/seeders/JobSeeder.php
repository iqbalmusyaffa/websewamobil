<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'slug' => 'senior-full-stack-developer',
                'category' => 'Engineering',
                'location' => 'Jakarta, Indonesia',
                'type' => 'Full-time',
                'work_mode' => 'Hybrid',
                'description' => '<h3>Tentang Posisi</h3>
<p>Kami mencari Senior Full Stack Developer yang berpengalaman untuk membantu kami membangun dan memelihara platform penyewaan kendaraan terdepan. Anda akan bekerja dengan teknologi modern dan berkolaborasi dengan tim yang passionate.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Mengembangkan fitur-fitur baru untuk web dan mobile platform</li>
<li>Melakukan code review dan mentoring untuk junior developers</li>
<li>Mengoptimalkan performa aplikasi</li>
<li>Berkolaborasi dengan tim design dan product</li>
<li>Mengelola database dan infrastruktur</li>
</ul>',
                'requirements' => [
                    '5+ tahun pengalaman di full stack development',
                    'Expert di PHP/Laravel',
                    'Expert di JavaScript/Vue.js atau React',
                    'Pengalaman dengan REST API',
                    'Pemahaman tentang database design',
                    'Familiar dengan Git dan CI/CD',
                    'Bahasa Inggris yang baik'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 12 - 18 juta)',
                    'Bonus kinerja',
                    'Asuransi kesehatan lengkap',
                    'Work from home flexible',
                    'Development budget',
                    'Stock options',
                    'Gym membership'
                ],
                'salary_from' => 12000000,
                'salary_to' => 18000000,
                'status' => 'Open'
            ],
            [
                'title' => 'Customer Service Representative',
                'slug' => 'customer-service-representative',
                'category' => 'Customer Success',
                'location' => 'Bandung, Indonesia',
                'type' => 'Full-time',
                'work_mode' => 'On-site',
                'description' => '<h3>Tentang Posisi</h3>
<p>Kami mencari Customer Service Representative yang energik untuk memberikan pengalaman layanan pelanggan terbaik. Anda akan menjadi first point of contact untuk semua pertanyaan dan masalah pelanggan kami.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Menangani pertanyaan dan keluhan pelanggan melalui berbagai channel</li>
<li>Memberikan solusi cepat dan profesional</li>
<li>Maintain customer satisfaction standards</li>
<li>Dokumentasi interaksi customer</li>
<li>Kolaborasi dengan tim lain untuk resolusi issues</li>
</ul>',
                'requirements' => [
                    '1+ tahun pengalaman di customer service',
                    'Excellent communication skills',
                    'Problem solving abilities',
                    'Patient dan empathetic',
                    'Native Bahasa Indonesia',
                    'Fluent in English',
                    'Familiar dengan CRM systems'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 4 - 6 juta)',
                    'Bonus insentif',
                    'Asuransi kesehatan',
                    'Tunjangan transportasi',
                    'Training berkelanjutan',
                    'Career growth opportunities'
                ],
                'salary_from' => 4000000,
                'salary_to' => 6000000,
                'status' => 'Open'
            ],
            [
                'title' => 'Digital Marketing Specialist',
                'slug' => 'digital-marketing-specialist',
                'category' => 'Marketing',
                'location' => 'Jakarta, Indonesia',
                'type' => 'Full-time',
                'work_mode' => 'Remote',
                'description' => '<h3>Tentang Posisi</h3>
<p>Kami mencari Digital Marketing Specialist yang kreatif untuk merancang dan mengeksekusi kampanye pemasaran digital. Anda akan membantu kami meningkatkan brand awareness dan customer acquisition.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Membuat strategi marketing digital</li>
<li>Mengelola social media campaigns</li>
<li>Mengoptimalkan SEO dan SEM</li>
<li>Analisis data dan reporting</li>
<li>Kolaborasi dengan tim content dan design</li>
</ul>',
                'requirements' => [
                    '2+ tahun pengalaman di digital marketing',
                    'Expert di social media management',
                    'Pengalaman dengan Google Analytics',
                    'Familiar dengan marketing tools (SEMrush, Hootsuite, etc)',
                    'Strong copywriting skills',
                    'Creative thinking',
                    'Data-driven mindset'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 8 - 12 juta)',
                    'Performance bonus',
                    'Asuransi kesehatan',
                    'Flexible working hours',
                    'Professional development',
                    'Equipment budget'
                ],
                'salary_from' => 8000000,
                'salary_to' => 12000000,
                'status' => 'Open'
            ],
            [
                'title' => 'Product Manager',
                'slug' => 'product-manager',
                'category' => 'Engineering',
                'location' => 'Jakarta, Indonesia',
                'type' => 'Full-time',
                'work_mode' => 'Hybrid',
                'description' => '<h3>Tentang Posisi</h3>
<p>Kami mencari Product Manager yang visioner untuk memimpin pengembangan produk kami. Anda akan bekerja dengan tim engineering, design, dan marketing untuk menciptakan produk yang amazing.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Mendefinisikan product roadmap</li>
<li>Menganalisis market dan user feedback</li>
<li>Membuat product requirements dan specifications</li>
<li>Kolaborasi dengan berbagai tim</li>
<li>Monitor product metrics dan KPIs</li>
</ul>',
                'requirements' => [
                    '3+ tahun pengalaman sebagai product manager',
                    'Pemahaman teknologi yang kuat',
                    'Excellent communication skills',
                    'Data analysis abilities',
                    'User research experience',
                    'Agile/Scrum knowledge',
                    'Startup experience is a plus'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 13 - 20 juta)',
                    'Performance bonus',
                    'Complete health insurance',
                    'Flexible arrangement',
                    'Stock options',
                    'Professional development budget'
                ],
                'salary_from' => 13000000,
                'salary_to' => 20000000,
                'status' => 'Open'
            ],
            [
                'title' => 'UI/UX Designer',
                'slug' => 'ui-ux-designer',
                'category' => 'Design',
                'location' => 'Jakarta, Indonesia',
                'type' => 'Full-time',
                'work_mode' => 'Hybrid',
                'description' => '<h3>Tentang Posisi</h3>
<p>Kami mencari UI/UX Designer yang bakat untuk menciptakan pengalaman user yang luar biasa. Anda akan bekerja pada web dan mobile platform kami yang digunakan jutaan user.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Desain user interface untuk web dan mobile</li>
<li>Conduct user research dan usability testing</li>
<li>Buat wireframes dan prototypes</li>
<li>Kolaborasi dengan product dan engineering</li>
<li>Maintain design system dan guidelines</li>
</ul>',
                'requirements' => [
                    '2+ tahun pengalaman di UI/UX design',
                    'Expert di design tools (Figma, Adobe XD)',
                    'Understanding of user-centered design',
                    'Knowledge of responsive design',
                    'Strong portfolio',
                    'Communication skills',
                    'Familiarity dengan web dan mobile design'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 8 - 12 juta)',
                    'Bonus kinerja',
                    'Asuransi kesehatan',
                    'Work life balance',
                    'Design tools and resources',
                    'Continuous learning'
                ],
                'salary_from' => 8000000,
                'salary_to' => 12000000,
                'status' => 'Open'
            ],
            [
                'title' => 'Junior Developer - Fresh Graduate Program',
                'slug' => 'junior-developer-fresh-graduate',
                'category' => 'Engineering',
                'location' => 'Jakarta, Indonesia',
                'type' => 'Internship',
                'work_mode' => 'On-site',
                'description' => '<h3>Tentang Posisi</h3>
<p>Program khusus untuk fresh graduate yang ingin memulai karir sebagai developer. Anda akan mendapatkan mentoring dari senior developers dan exposure ke real world project.</p>

<h3>Tanggung Jawab</h3>
<ul>
<li>Learn modern web development practices</li>
<li>Assist senior developers dalam project development</li>
<li>Write clean dan maintainable code</li>
<li>Participate dalam code review</li>
<li>Continuous learning dan improvement</li>
</ul>',
                'requirements' => [
                    'Fresh graduate or currently studying',
                    'Basic understanding of programming',
                    'Familiar dengan PHP/Laravel atau JavaScript',
                    'Willingness to learn',
                    'Good communication skills',
                    'Passion untuk development',
                    'Problem solving mindset'
                ],
                'benefits' => [
                    'Gaji kompetitif (Rp 3 - 4 juta)',
                    'Mentorship program',
                    'Asuransi kesehatan',
                    'Training dan sertifikasi',
                    'Potential untuk permanent',
                    'Networking opportunities'
                ],
                'salary_from' => 3000000,
                'salary_to' => 4000000,
                'status' => 'Open'
            ]
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
