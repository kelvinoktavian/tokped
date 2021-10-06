<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carousels = Carousel::all();

        if ($carousels->count() == 0) {
            $carousel = [
                [
                    'title' => 'Carousel 1',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam sed nulla explicabo aut autem architecto itaque minus ab quasi neque!',
                    'image_path' => '1.jpg',
                ],
                [
                    'title' => 'Carousel 2',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam sed nulla explicabo aut autem architecto itaque minus ab quasi neque!',
                    'image_path' => '2.jpg',
                ],
                [
                    'title' => 'Carousel 3',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam sed nulla explicabo aut autem architecto itaque minus ab quasi neque!',
                    'image_path' => '3.jpg',
                ],
            ];

            foreach ($carousel as $key => $value) {
                Carousel::create($value);
            }
        }
    }
}
