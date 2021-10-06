<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $products = Product::all();

        if ($products->count() == 0) {
            $product = [
                // GS - Aki Mobil
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-40',
                    'name' => 'GS MF NS 40',
                    'price' => 700000,
                    'voltage' => 12,
                    'capacity' => 32,
                    'weight' => 10000,
                    'description' => 'GS MF NS 40 - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-40-z',
                    'name' => 'GS MF NS 40 Z',
                    'price' => 750000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'GS MF NS 40 Z - Maintenance Free',
                    'qty' => 3,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-40-zl',
                    'name' => 'GS MF NS 40 ZL',
                    'price' => 750000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'GS MF NS 40 ZL - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-60',
                    'name' => 'GS MF NS 60',
                    'price' => 800000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'GS MF NS 60 - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-60-l',
                    'name' => 'GS MF NS 60 L',
                    'price' => 800000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'GS MF NS 60 L - Maintenance Free',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-ns-70',
                    'name' => 'GS MF NS 70',
                    'price' => 900000,
                    'voltage' => 12,
                    'capacity' => 65,
                    'weight' => 15000,
                    'description' => 'GS MF NS 70 - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-n-70',
                    'name' => 'GS MF N 70',
                    'price' => 950000,
                    'voltage' => 12,
                    'capacity' => 70,
                    'weight' => 17000,
                    'description' => 'GS MF N 70 - Maintenance Free',
                    'qty' => 3,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-mf-n-70-z',
                    'name' => 'GS MF N 70 Z',
                    'price' => 1000000,
                    'voltage' => 12,
                    'capacity' => 75,
                    'weight' => 20000,
                    'description' => 'GS MF N 70 Z - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-n-100',
                    'name' => 'GS N 100',
                    'price' => 1500000,
                    'voltage' => 12,
                    'capacity' => 100,
                    'weight' => 25000,
                    'description' => 'GS N 100 - Premium',
                    'qty' => 1,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-n-120',
                    'name' => 'GS N 120',
                    'price' => 2000000,
                    'voltage' => 12,
                    'capacity' => 120,
                    'weight' => 25000,
                    'description' => 'GS N 120 - Premium',
                    'qty' => 0,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-n-150',
                    'name' => 'GS N 150',
                    'price' => 2500000,
                    'voltage' => 12,
                    'capacity' => 150,
                    'weight' => 30000,
                    'description' => 'GS N 150 - Premium',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 1,
                    'slug' => 'gs-n-200',
                    'name' => 'GS N 200',
                    'price' => 3000000,
                    'voltage' => 12,
                    'capacity' => 200,
                    'weight' => 40000,
                    'description' => 'GS N 200 - Premium',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                // GS - Aki Motor
                [
                    'brand_id' => 1,
                    'category_id' => 2,
                    'slug' => 'gs-mf-gtz5s',
                    'name' => 'GS MF GTZ5S',
                    'price' => 200000,
                    'voltage' => 12,
                    'capacity' => 4,
                    'weight' => 5000,
                    'description' => 'GS MF GTZ5S',
                    'qty' => 20,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 2,
                    'slug' => 'gs-mf-gm5z',
                    'name' => 'GS MF GM5Z',
                    'price' => 190000,
                    'voltage' => 12,
                    'capacity' => 5,
                    'weight' => 6000,
                    'description' => 'GS MF GM5Z',
                    'qty' => 15,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 2,
                    'slug' => 'gs-mf-gtz6v',
                    'name' => 'GS MF GTZ6V',
                    'price' => 220000,
                    'voltage' => 12,
                    'capacity' => 6,
                    'weight' => 6000,
                    'description' => 'GS MF GTZ6V',
                    'qty' => 9,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 1,
                    'category_id' => 2,
                    'slug' => 'gs-mf-gtz7v',
                    'name' => 'GS MF GTZ7V',
                    'price' => 275000,
                    'voltage' => 12,
                    'capacity' => 7,
                    'weight' => 7000,
                    'description' => 'GS MF GTZ7V',
                    'qty' => 3,
                    'image_path' => 'default.png'
                ],

                // Yuasa - Aki Mobil
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-40',
                    'name' => 'Yuasa MF NS 40',
                    'price' => 699000,
                    'voltage' => 12,
                    'capacity' => 32,
                    'weight' => 10000,
                    'description' => 'Yuasa MF NS 40 - Maintenance Free',
                    'qty' => 1,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-40-z',
                    'name' => 'Yuasa MF NS 40 Z',
                    'price' => 749000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'Yuasa MF NS 40 Z - Maintenance Free',
                    'qty' => 7,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-40-zl',
                    'name' => 'Yuasa MF NS 40 ZL',
                    'price' => 749000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'Yuasa MF NS 40 ZL - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-60',
                    'name' => 'Yuasa MF NS 60',
                    'price' => 799000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'Yuasa MF NS 60 - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-60-l',
                    'name' => 'Yuasa MF NS 60 L',
                    'price' => 799000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'Yuasa MF NS 60 L - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-ns-70',
                    'name' => 'Yuasa MF NS 70',
                    'price' => 850000,
                    'voltage' => 12,
                    'capacity' => 65,
                    'weight' => 15000,
                    'description' => 'Yuasa MF NS 70 - Maintenance Free',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-n-70',
                    'name' => 'Yuasa MF N 70',
                    'price' => 949000,
                    'voltage' => 12,
                    'capacity' => 70,
                    'weight' => 17000,
                    'description' => 'Yuasa MF N 70 - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-mf-n-70-z',
                    'name' => 'Yuasa MF N 70 Z',
                    'price' => 1000000,
                    'voltage' => 12,
                    'capacity' => 75,
                    'weight' => 20000,
                    'description' => 'Yuasa MF N 70 Z - Maintenance Free',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-n-100',
                    'name' => 'Yuasa N 100',
                    'price' => 1499000,
                    'voltage' => 12,
                    'capacity' => 100,
                    'weight' => 25000,
                    'description' => 'Yuasa N 100',
                    'qty' => 0,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-n-120',
                    'name' => 'Yuasa N 120',
                    'price' => 2000000,
                    'voltage' => 12,
                    'capacity' => 120,
                    'weight' => 25000,
                    'description' => 'Yuasa N 120',
                    'qty' => 0,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-n-150',
                    'name' => 'Yuasa N 150',
                    'price' => 2500000,
                    'voltage' => 12,
                    'capacity' => 150,
                    'weight' => 30000,
                    'description' => 'Yuasa N 150',
                    'qty' => 0,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 1,
                    'slug' => 'yuasa-n-200',
                    'name' => 'Yuasa N 200',
                    'price' => 3000000,
                    'voltage' => 12,
                    'capacity' => 200,
                    'weight' => 40000,
                    'description' => 'Yuasa N 200',
                    'qty' => 0,
                    'image_path' => 'default.png'
                ],
                // Yuasa - Aki Motor
                [
                    'brand_id' => 2,
                    'category_id' => 2,
                    'slug' => 'yuasa-mf-ytz5s',
                    'name' => 'Yuasa MF YTZ5S',
                    'price' => 200000,
                    'voltage' => 12,
                    'capacity' => 4,
                    'weight' => 5000,
                    'description' => 'Yuasa MF YTZ5S',
                    'qty' => 10,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 2,
                    'slug' => 'yuasa-mf-yt7c',
                    'name' => 'Yuasa MF YT7C',
                    'price' => 190000,
                    'voltage' => 12,
                    'capacity' => 5,
                    'weight' => 6000,
                    'description' => 'Yuasa MF YT7C',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 2,
                    'slug' => 'yuasa-mf-ytz6v',
                    'name' => 'Yuasa MF YTZ6V',
                    'price' => 220000,
                    'voltage' => 12,
                    'capacity' => 6,
                    'weight' => 6000,
                    'description' => 'Yuasa MF YTZ6V',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 2,
                    'category_id' => 2,
                    'slug' => 'yuasa-mf-ytz7v',
                    'name' => 'Yuasa MF YTZ7V',
                    'price' => 275000,
                    'voltage' => 12,
                    'capacity' => 7,
                    'weight' => 7000,
                    'description' => 'Yuasa MF YTZ7V',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],

                // Incoe - Aki Mobil
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-40',
                    'name' => 'Incoe MF NS 40',
                    'price' => 700000,
                    'voltage' => 12,
                    'capacity' => 32,
                    'weight' => 10000,
                    'description' => 'Incoe MF NS 40 - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-40-z',
                    'name' => 'Incoe MF NS 40 Z',
                    'price' => 750000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'Incoe MF NS 40 Z - Maintenance Free',
                    'qty' => 3,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-40-zl',
                    'name' => 'Incoe MF NS 40 ZL',
                    'price' => 750000,
                    'voltage' => 12,
                    'capacity' => 35,
                    'weight' => 10000,
                    'description' => 'Incoe MF NS 40 ZL - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-60',
                    'name' => 'Incoe MF NS 60',
                    'price' => 800000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'Incoe MF NS 60 - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-60-l',
                    'name' => 'Incoe MF NS 60 L',
                    'price' => 800000,
                    'voltage' => 12,
                    'capacity' => 45,
                    'weight' => 12000,
                    'description' => 'Incoe MF NS 60 L - Maintenance Free',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-ns-70',
                    'name' => 'Incoe MF NS 70',
                    'price' => 900000,
                    'voltage' => 12,
                    'capacity' => 65,
                    'weight' => 15000,
                    'description' => 'Incoe MF NS 70 - Maintenance Free',
                    'qty' => 5,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-n-70',
                    'name' => 'Incoe MF N 70',
                    'price' => 950000,
                    'voltage' => 12,
                    'capacity' => 70,
                    'weight' => 17000,
                    'description' => 'Incoe MF N 70 - Maintenance Free',
                    'qty' => 3,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-mf-n-70-z',
                    'name' => 'Incoe MF N 70 Z',
                    'price' => 1000000,
                    'voltage' => 12,
                    'capacity' => 75,
                    'weight' => 20000,
                    'description' => 'Incoe MF N 70 Z - Maintenance Free',
                    'qty' => 4,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-n-100',
                    'name' => 'Incoe N 100',
                    'price' => 1500000,
                    'voltage' => 12,
                    'capacity' => 100,
                    'weight' => 25000,
                    'description' => 'Incoe N 100 - Premium',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-n-120',
                    'name' => 'Incoe N 120',
                    'price' => 2000000,
                    'voltage' => 12,
                    'capacity' => 120,
                    'weight' => 25000,
                    'description' => 'Incoe N 120 - Premium',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-n-150',
                    'name' => 'Incoe N 150',
                    'price' => 2500000,
                    'voltage' => 12,
                    'capacity' => 150,
                    'weight' => 30000,
                    'description' => 'Incoe N 150 - Premium',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
                [
                    'brand_id' => 3,
                    'category_id' => 1,
                    'slug' => 'incoe-n-200',
                    'name' => 'Incoe N 200',
                    'price' => 3000000,
                    'voltage' => 12,
                    'capacity' => 200,
                    'weight' => 40000,
                    'description' => 'Incoe N 200 - Premium',
                    'qty' => 2,
                    'image_path' => 'default.png'
                ],
            ];

            foreach ($product as $key => $value) {
                Product::create($value);
            }
        }
    }
}
