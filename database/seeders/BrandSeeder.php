<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = Brand::all();

        if ($brands->count() == 0) {
            $brand = [
                [
                    'slug' => 'gs',
                    'name' => 'GS',
                    'image_path' => 'default.png',
                ],
                [
                    'slug' => 'yuasa',
                    'name' => 'Yuasa',
                    'image_path' => 'default.png',
                ],
                [
                    'slug' => 'incoe',
                    'name' => 'Incoe',
                    'image_path' => 'default.png',
                ],
            ];

            foreach ($brand as $key => $value) {
                Brand::create($value);
            }
        }
    }
}
