<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Laptop Lenovo ThinkPad X1',
                'description' => 'Ultrabook ligera y potente, ideal para productividad empresarial.',
                'price' => 1500.00,
                'tax_cost' => 240.00,
                'manufacturing_cost' => 900.00,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monitor Samsung UltraWide 34"',
                'description' => 'Monitor curvo con resolución UltraWide para tareas de productividad y diseño.',
                'price' => 600.00,
                'tax_cost' => 96.00,
                'manufacturing_cost' => 350.00,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teclado Mecánico Logitech MX Keys',
                'description' => 'Teclado inalámbrico de alto rendimiento con retroiluminación.',
                'price' => 120.00,
                'tax_cost' => 19.20,
                'manufacturing_cost' => 50.00,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silla Ergonómica Ergohuman',
                'description' => 'Silla de oficina ergonómica con soporte lumbar ajustable.',
                'price' => 400.00,
                'tax_cost' => 64.00,
                'manufacturing_cost' => 200.00,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Memoria USB Kingston 128GB',
                'description' => 'Memoria flash USB 3.0 de alta velocidad y gran capacidad.',
                'price' => 25.00,
                'tax_cost' => 4.00,
                'manufacturing_cost' => 8.00,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
