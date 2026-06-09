<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealMenu;

class MealMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Menu Gratis (is_premium: false)
            ['name' => 'Nasi Campur / Rames Spesial + Es Teh', 'is_premium' => false, 'is_active' => true],
            ['name' => 'Nasi Goreng Jawa + Telur + Es Teh', 'is_premium' => false, 'is_active' => true],
            ['name' => 'Soto Ayam Lamongan + Nasi + Es Teh', 'is_premium' => false, 'is_active' => true],
            ['name' => 'Mie Goreng Spesial + Telur + Es Teh', 'is_premium' => false, 'is_active' => true],
            ['name' => 'Bakso Malang Komplit + Es Teh', 'is_premium' => false, 'is_active' => true],
            
            // Menu Premium (is_premium: true)
            ['name' => 'Nasi Padang Rendang Daging Sapi + Es Jeruk', 'is_premium' => true, 'is_active' => true],
            ['name' => 'Nasi Iga Bakar Madu + Sop + Es Jeruk', 'is_premium' => true, 'is_active' => true],
            ['name' => 'Nasi Bebek Goreng Kremes Spesial + Es Jeruk', 'is_premium' => true, 'is_active' => true],
            ['name' => 'Nasi Sate Ayam Madura (10 Tusuk) + Lontong + Es Jeruk', 'is_premium' => true, 'is_active' => true],
            ['name' => 'Nasi Ayam Bakar Taliwang + Plecing + Es Jeruk', 'is_premium' => true, 'is_active' => true],
        ];

        foreach ($menus as $menu) {
            MealMenu::firstOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}
