<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        if ($categories->count() == 0) {
            $category = [
                [
                    'slug' => 'aki-mobil',
                    'name' => 'Aki Mobil',
                ],
                [
                    'slug' => 'aki-motor',
                    'name' => 'Aki Motor',
                ],
                [
                    'slug' => 'lain-lain',
                    'name' => 'Lain-lain',
                ],
            ];

            foreach ($category as $key => $value) {
                Category::create($value);
            }
        }
    }
}
