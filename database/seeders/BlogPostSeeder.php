<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => '5 Tips Memilih Mobil Rental untuk Liburan Anda',
                'slug' => '5-tips-memilih-mobil-rental-untuk-liburan',
                'author' => 'Admin AutoRent',
                'category' => 'Tips',
                'excerpt' => 'Panduan lengkap memilih kendaraan rental yang tepat untuk perjalanan Anda dengan nyaman dan aman.',
                'content' => '<h2>Memilih Mobil Rental yang Tepat</h2>
<p>Memilih kendaraan rental untuk liburan Anda adalah keputusan yang penting. Berikut tips-tips yang dapat membantu Anda:</p>
<h3>1. Tentukan Kebutuhan Anda</h3>
<p>Pertimbangkan jumlah penumpang, apakah perlu bagasi besar, dan kenyamanan yang diinginkan. Untuk keluarga kecil, mobil sedan mungkin cukup. Untuk keluarga besar, pilih MPV atau SUV.</p>
<h3>2. Pertimbangkan Bahan Bakar</h3>
<p>Mobil bensin lebih fleksibel untuk perjalanan panjang, sementara diesel lebih hemat bahan bakar. Lihat rute perjalanan Anda dan pilih yang paling ekonomis.</p>
<h3>3. Periksa Kondisi Kendaraan</h3>
<p>Selalu periksa kondisi kendaraan sebelum menerima, termasuk ban, lampu, AC, dan interior. Dokumentasikan semua kerusakan yang ada sebelumnya.</p>
<h3>4. Bandingkan Harga</h3>
<p>Jangan langsung menerima penawaran pertama. Bandingkan harga dari beberapa penyedia rental untuk mendapatkan deal terbaik.</p>
<h3>5. Pilih Asuransi yang Tepat</h3>
<p>Asuransi penting untuk melindungi Anda dari risiko tak terduga. Periksa coverage yang ditawarkan dan pastikan Anda memahami syarat dan ketentuan.</p>',
                'status' => 'Published',
                'published_at' => Carbon::now()->subDays(5),
                'views' => 234,
            ],
            [
                'title' => 'Panduan Perawatan Mobil Rental Agar Terhindar dari Denda',
                'slug' => 'panduan-perawatan-mobil-rental',
                'author' => 'Admin AutoRent',
                'category' => 'Tips',
                'excerpt' => 'Ketahui cara merawat mobil rental dengan baik agar tidak terkena denda kerusakan saat mengembalikan.',
                'content' => '<h2>Cara Merawat Mobil Rental</h2>
<p>Merawat mobil rental dengan baik adalah tanggung jawab penyewa. Ikuti panduan ini untuk menghindari denda tambahan:</p>
<h3>Perawatan Harian</h3>
<ul>
<li>Jangan parkir di tempat yang terlalu panas atau terik matahari langsung</li>
<li>Hindari mengemudi di jalanan yang berlumpur atau banjir</li>
<li>Bersihkan interior mobil setiap hari dari sampah</li>
<li>Jangan merokok di dalam mobil</li>
<li>Hindari membawa barang berbau tajam</li>
</ul>
<h3>Pemeriksaan Rutin</h3>
<ul>
<li>Periksa tekanan ban setiap pagi sebelum berkendara</li>
<li>Pastikan level cairan pendingin dan oli mesin normal</li>
<li>Cek kondisi lampu depan dan belakang</li>
<li>Verifikasi fungsi AC berkerjaa baik</li>
</ul>
<h3>Jika Terjadi Insiden</h3>
<p>Segera hubungi customer service kami jika terjadi kerusakan, kebocoran, atau masalah apapun dengan kendaraan. Dokumentasikan dengan foto dan laporan resmi dari pihak yang berwenang jika ada kecelakaan.</p>',
                'status' => 'Published',
                'published_at' => Carbon::now()->subDays(3),
                'views' => 156,
            ],
            [
                'title' => 'Perbedaan Sedan, SUV, dan MPV: Mana yang Cocok untuk Anda?',
                'slug' => 'perbedaan-sedan-suv-mpv',
                'author' => 'Admin AutoRent',
                'category' => 'Teknologi',
                'excerpt' => 'Memahami perbedaan tipe kendaraan akan membantu Anda memilih yang paling sesuai dengan kebutuhan.',
                'content' => '<h2>Tipe-Tipe Kendaraan</h2>
<p>Setiap tipe kendaraan memiliki karakteristik uniknya. Mari kita pelajari perbedaannya:</p>
<h3>Sedan</h3>
<p><strong>Kelebihan:</strong> Hemat bahan bakar, mudah dikendalikan, cocok untuk kota, tarif asuransi lebih murah</p>
<p><strong>Kekurangan:</strong> Bagasi terbatas, tidak cocok untuk medan berat, ketinggian rendah</p>
<p><strong>Cocok untuk:</strong> Perjalanan bisnis, commuting harian, pasangan atau keluarga kecil</p>
<h3>SUV</h3>
<p><strong>Kelebihan:</strong> Pandangan pengemudi lebih tinggi, lebih stabil di medan berat, bisa off-road, kapasitas besar</p>
<p><strong>Kekurangan:</strong> Konsumsi bahan bakar lebih boros, harga lebih mahal, lebih sulit dikendalikan di kota</p>
<p><strong>Cocok untuk:</strong> Petualangan, perjalanan keluarga, medan berat, towing</p>
<h3>MPV</h3>
<p><strong>Kelebihan:</strong> Kapasitas penumpang besar (7-8 orang), bagasi luas, interior nyaman</p>
<p><strong>Kekurangan:</strong> Konsumsi bahan bakar boros, ukuran besar sulit parkir, harga tinggi</p>
<p><strong>Cocok untuk:</strong> Keluarga besar, acara keluarga, perjalanan group, tour</p>',
                'status' => 'Published',
                'published_at' => Carbon::now()->subDays(2),
                'views' => 320,
            ],
            [
                'title' => 'Tren Mobil Listrik 2026: Masa Depan Transportasi',
                'slug' => 'tren-mobil-listrik-2026',
                'author' => 'Admin AutoRent',
                'category' => 'Teknologi',
                'excerpt' => 'Perkembangan teknologi mobil listrik terus berkembang. Apa saja tren terbaru di tahun 2026?',
                'content' => '<h2>Revolusi Mobil Listrik</h2>
<p>Tahun 2026 menandai era baru dalam industri otomotif dengan makin dominannya kendaraan listrik (EV). Mari kita lihat tren terbaru:</p>
<h3>Jangkauan Baterai yang Lebih Jauh</h3>
<p>Teknologi baterai terbaru memungkinkan mobil listrik menempuh jarak lebih jauh, hingga 600+ km per sekali charge. Ini menghilangkan kekhawatiran tentang kehabisan daya.</p>
<h3>Charging Infrastructure Meningkat</h3>
<p>Infrastruktur charging (pengisian daya) di berbagai kota terus berkembang. Semakin banyak charging station membuat EV semakin praktis digunakan.</p>
<h3>Harga Lebih Terjangkau</h3>
<p>Harga mobil listrik semakin kompetitif dengan model ICE (internal combustion engine) berkat produksi massal dan penurunan biaya baterai.</p>
<h3>Fitur Keselamatan Canggih</h3>
<p>Semua mobil listrik modern dilengkapi dengan autonomous driving features, lane keeping assist, dan emergency braking systems yang sophisticated.</p>
<h3>Desain yang Lebih Menarik</h3>
<p>Manufaktur kini lebih kreatif dengan desain mobil listrik yang futuristik dan sporty, tidak lagi terlihat "weird" atau berbeda dari mobil tradisional.</p>',
                'status' => 'Published',
                'published_at' => Carbon::now()->subDays(1),
                'views' => 425,
            ],
            [
                'title' => 'Update Layanan AutoRent: Fitur Baru dan Peningkatan',
                'slug' => 'update-layanan-autorent-fitur-baru',
                'author' => 'Admin AutoRent',
                'category' => 'Berita',
                'excerpt' => 'AutoRent terus berinovasi untuk memberikan pengalaman rental terbaik. Lihat fitur-fitur baru kami!',
                'content' => '<h2>Update AutoRent Mei 2026</h2>
<p>Kami dengan bangga mengumumkan sejumlah fitur baru dan peningkatan layanan untuk memberikan pengalaman terbaik bagi pelanggan setia kami.</p>
<h3>Mobile App v3.0</h3>
<p>Aplikasi mobile kami telah diperbarui dengan interface yang lebih intuitif, fitur real-time tracking untuk armada kami, dan integrasi dengan dompet digital untuk pembayaran yang lebih mudah.</p>
<h3>Layanan Antar-Jemput Gratis</h3>
<p>Mulai sekarang, semua booking rental dengan durasi 3 hari atau lebih mendapatkan layanan antar-jemput gratis ke lokasi Anda di Jakarta dan Bandung.</p>
<h3>Program Loyalitas Baru</h3>
<p>Member program kami sekarang bisa mengumpulkan poin dari setiap transaksi dan menukarnya dengan potongan harga, gratis rental, atau upgrade kendaraan.</p>
<h3>24/7 Customer Support</h3>
<p>Tim customer service kami sekarang tersedia 24 jam sehari, 7 hari seminggu untuk membantu Anda dengan masalah apapun selama perjalanan Anda.</p>
<h3>Armada Kendaraan Baru</h3>
<p>Kami telah menambahkan 50 unit kendaraan terbaru ke armada kami, termasuk beberapa model hybrid dan electric vehicle untuk pelanggan yang peduli lingkungan.</p>',
                'status' => 'Published',
                'published_at' => Carbon::now(),
                'views' => 178,
            ],
            [
                'title' => 'Cara Menghemat Budget untuk Liburan dengan Rental Mobil',
                'slug' => 'cara-menghemat-budget-rental-mobil',
                'author' => 'Admin AutoRent',
                'category' => 'Tips',
                'excerpt' => 'Tips dan trik menghemat biaya rental mobil agar liburan Anda lebih ekonomis tanpa mengorbankan kenyamanan.',
                'content' => '<h2>Hemat Biaya Rental Mobil</h2>
<p>Menjalani liburan impian tidak harus menguras kantong. Berikut tips menghemat biaya rental mobil:</p>
<h3>Booking di Luar Musim Ramai</h3>
<p>Harga rental mobil biasanya lebih murah pada hari biasa (Senin-Jumat) dan musim low season. Booking di waktu-waktu ini bisa menghemat hingga 30-40%.</p>
<h3>Pilih Paket Long-Term</h3>
<p>Jika menginap 7 hari atau lebih, sewa bulanan (monthly rental) biasanya lebih murah dibanding harian. Hitung per hari rental bulanan sering lebih hemat.</p>
<h3>Bandingkan Berbagai Perusahaan</h3>
<p>Jangan hanya mengandalkan satu penyedia. Gunakan comparison tools atau kunjungi langsung berbagai rental companies untuk mendapatkan deal terbaik.</p>
<h3>Manfaatkan Promo dan Diskon</h3>
<p>Follow media sosial perusahaan rental untuk update promo terbaru, kode diskon, dan penawaran spesial. Subscriber newsletter sering mendapat deal eksklusif.</p>
<h3>Pertimbangkan Asuransi dengan Bijak</h3>
<p>Jika Anda sudah memiliki asuransi mobil pribadi atau kartu kredit dengan coverage rental car, Anda mungkin tidak perlu membeli asuransi tambahan dari rental company.</p>
<h3>Isi Bahan Bakar Sendiri</h3>
<p>Mengisi bahan bakar sendiri sebelum mengembalikan mobil jauh lebih murah daripada membiarkan rental company mengisinya dengan tarif yang jauh lebih tinggi.</p>',
                'status' => 'Published',
                'published_at' => Carbon::now()->subDays(4),
                'views' => 289,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
