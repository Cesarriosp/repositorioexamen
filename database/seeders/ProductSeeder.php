<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nombre' => 'Laptop Dell XPS 15',
                'precio' => 1299.99,
                'stock' => 25,
            ],
            [
                'nombre' => 'Mouse Inalámbrico Logitech',
                'precio' => 29.99,
                'stock' => 150,
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'precio' => 89.50,
                'stock' => 45,
            ],
            [
                'nombre' => 'Monitor 27" 4K',
                'precio' => 399.00,
                'stock' => 8,
            ],
            [
                'nombre' => 'Auriculares Bluetooth',
                'precio' => 59.99,
                'stock' => 0,
            ],
            [
                'nombre' => 'Webcam HD 1080p',
                'precio' => 49.99,
                'stock' => 35,
            ],
            [
                'nombre' => 'SSD 1TB NVMe',
                'precio' => 119.99,
                'stock' => 60,
            ],
            [
                'nombre' => 'Memoria RAM 16GB DDR4',
                'precio' => 79.00,
                'stock' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
