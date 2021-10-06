<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_cities = City::all();

        if ($check_cities->count() == 0) {
            $response = Http::withHeaders([
                'key' => 'f0b33c568115700d063a8ee20db9763a'
            ])->get('https://api.rajaongkir.com/starter/city');

            $cities = $response['rajaongkir']['results'];

            foreach ($cities as $city) {
                $data_city[] = [
                    'id' => $city['city_id'],
                    'province_id' => $city['province_id'],
                    'type' => $city['type'],
                    'city_name' => $city['city_name'],
                    'postal_code' => $city['postal_code'],
                ];
            }

            City::insert($data_city);
        }
    }
}
