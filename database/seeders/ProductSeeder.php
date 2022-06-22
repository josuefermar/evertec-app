<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Soundcore Audifonos',
                'price' => '235000',
                'image_name' => 'soundcore_audifonos.jpg',
            ],
            [
                'name' => 'Ultimate Ears Wonderboom 2',
                'price' => '323419',
                'image_name' => 'ultimate_ears_wonderboom_2.jpg',
            ],
            [
                'name' => 'The Everyday Raycon - Auriculares inalámbricos',
                'price' => '318640',
                'image_name' => 'the_everyday_raycon.jpg',
            ],
            [
                'name' => 'Treblab Hd77 - Altavoz Bluetooth Ultra Premium',
                'price' => '358470',
                'image_name' => 'treblab_hd77.jpg',
            ],
            [
                'name' => 'Tinwoo Reloj Inteligente Para Hombres Y Mujeres',
                'price' => '219065',
                'image_name' => 'tinwoo_reloj_inteligente.jpg',
            ],
            [
                'name' => 'Samsung Evo Select + Adaptador 512 GB',
                'price' => '258895',
                'image_name' => 'samsung_evo_select.jpg',
            ],
            [
                'name' => 'Lenovo IdeaPad 3 Laptop',
                'price' => '1991500',
                'image_name' => 'lenovo_ideapad_3_laptop.jpg',
            ],
            [
                'name' => 'AMD Ryzen 7 5800X 8 núcleos',
                'price' => '1792350',
                'image_name' => 'amd_ryzen_7.jpg',
            ],
            [
                'name' => 'Xbox Wireless Controller – Pulse Red',
                'price' => '211099',
                'image_name' => 'xbox_wireless_controller_pulse_red.jpg',
            ],
            [
                'name' => 'TOZO T6',
                'price' => '199150',
                'image_name' => 'tozo_t6.jpg',
            ],
        ];

        Product::insert($products);
    }
}
