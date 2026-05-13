<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'Jakarta Pusat',
                'slug' => 'jakarta',
                'city' => 'Jakarta',
                'address' => 'Jl. Gatot Subroto No. 123, Karet Semanggi, Jakarta Selatan, 12930',
                'phone' => '+62-21-1234567',
                'whatsapp' => '+62-812-1234567',
                'email' => 'jakarta@autorent.com',
                'operational_hours' => [
                    'opening_time' => '08:00',
                    'closing_time' => '22:00',
                ],
                'description' => 'Kantor cabang utama AutoRent di Jakarta. Kami menyediakan layanan penyewaan mobil lengkap dengan armada terbaru dan profesional berpengalaman.',
                'features' => ['Free WiFi', '24/7 Call Center', 'Antar Jemput Gratis', 'Asuransi All Risk', 'Driver Bersertifikat'],
                'cover_image' => 'https://images.unsplash.com/photo-1555899434-94d1368aa7af?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1555899434-94d1368aa7af?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1535122066461-dbf9e675b865?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1493857671505-72967e2e2760?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                ],
                'maps_url' => 'https://maps.google.com/maps?q=Jakarta+Pusat&t=m&z=13&ie=UTF8&iwloc=&output=embed',
                'latitude' => -6.2088,
                'longitude' => 106.8000,
                'total_vehicles' => 45,
                'rating' => 4.8,
                'total_reviews' => 324,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Bali (Denpasar)',
                'slug' => 'bali',
                'city' => 'Bali',
                'address' => 'Jl. Raya Ubud No. 456, Ubud, Gianyar, Bali 80571',
                'phone' => '+62-361-2345678',
                'whatsapp' => '+62-812-2345678',
                'email' => 'bali@autorent.com',
                'operational_hours' => [
                    'opening_time' => '07:00',
                    'closing_time' => '23:00',
                ],
                'description' => 'Cabang AutoRent di Bali melayani pariwisata lokal dan internasional dengan armada mobil travel dan sedan mewah.',
                'features' => ['Airport Transfer', 'Tour Package', 'Multilingual Driver', 'AC Full', 'Breakfast Included'],
                'cover_image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1495442871050-f05a96d84b47?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                ],
                'maps_url' => 'https://maps.google.com/maps?q=Bali+Denpasar&t=m&z=13&ie=UTF8&iwloc=&output=embed',
                'latitude' => -8.6705,
                'longitude' => 115.2126,
                'total_vehicles' => 38,
                'rating' => 4.9,
                'total_reviews' => 287,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Bandung',
                'slug' => 'bandung',
                'city' => 'Bandung',
                'address' => 'Jl. Dago No. 789, Bandung, Jawa Barat 40391',
                'phone' => '+62-22-3456789',
                'whatsapp' => '+62-812-3456789',
                'email' => 'bandung@autorent.com',
                'operational_hours' => [
                    'opening_time' => '08:00',
                    'closing_time' => '21:00',
                ],
                'description' => 'Penyewaan mobil terpercaya di Bandung untuk kebutuhan bisnis, liburan, dan perjalanan keluarga.',
                'features' => ['Harga Terjangkau', 'Maintenance Rutin', 'Customer Support 24/7', 'Bensin Penuh', 'Asuransi Komprehensif'],
                'cover_image' => 'https://images.unsplash.com/photo-1549473889-14f410d83298?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1549473889-14f410d83298?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1486661590350-2024a4fdf16c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                ],
                'maps_url' => 'https://maps.google.com/maps?q=Bandung+Dago&t=m&z=13&ie=UTF8&iwloc=&output=embed',
                'latitude' => -6.8957,
                'longitude' => 107.6338,
                'total_vehicles' => 32,
                'rating' => 4.7,
                'total_reviews' => 156,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Surabaya',
                'slug' => 'surabaya',
                'city' => 'Surabaya',
                'address' => 'Jl. Ahmad Yani No. 101, Surabaya, Jawa Timur 60188',
                'phone' => '+62-31-4567890',
                'whatsapp' => '+62-812-4567890',
                'email' => 'surabaya@autorent.com',
                'operational_hours' => [
                    'opening_time' => '08:00',
                    'closing_time' => '22:00',
                ],
                'description' => 'Layanan rental mobil berkualitas di Surabaya dengan armada terawat dan sopir berpengalaman.',
                'features' => ['Mobil Bersih', 'GPS Navigation', 'Emergency Support', 'Dokumentasi Lengkap', 'Booking Fleksibel'],
                'cover_image' => 'https://images.unsplash.com/photo-1583597405105-0f8a84d412d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1583597405105-0f8a84d412d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1507950547519-052ec2dea126?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1460355894917-8a81685a5f3d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                ],
                'maps_url' => 'https://maps.google.com/maps?q=Surabaya+Ahmad+Yani&t=m&z=13&ie=UTF8&iwloc=&output=embed',
                'latitude' => -7.2506,
                'longitude' => 112.7508,
                'total_vehicles' => 28,
                'rating' => 4.6,
                'total_reviews' => 98,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Yogyakarta',
                'slug' => 'yogyakarta',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Malioboro No. 212, Yogyakarta, DIY 55271',
                'phone' => '+62-274-5678901',
                'whatsapp' => '+62-812-5678901',
                'email' => 'yogya@autorent.com',
                'operational_hours' => [
                    'opening_time' => '07:30',
                    'closing_time' => '21:30',
                ],
                'description' => 'Penyewaan mobil di Yogyakarta untuk wisata budaya, keluarga, dan perjalanan bisnis.',
                'features' => ['Wisata Ramah', 'Harga Kompetitif', 'Sopir Ramah', 'AC Sejuk', 'Dokumentasi Foto'],
                'cover_image' => 'https://images.unsplash.com/photo-1584814881062-817ab5366dc0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1584814881062-817ab5366dc0?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1488747807830-63789f68bb65?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                ],
                'maps_url' => 'https://maps.google.com/maps?q=Yogyakarta+Malioboro&t=m&z=13&ie=UTF8&iwloc=&output=embed',
                'latitude' => -7.8000,
                'longitude' => 110.3595,
                'total_vehicles' => 25,
                'rating' => 4.8,
                'total_reviews' => 142,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
