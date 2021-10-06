<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_provinces = Province::all();

        if ($check_provinces->count() == 0) {
            $response = Http::withHeaders([
                'key' => 'f0b33c568115700d063a8ee20db9763a'
            ])->get('https://api.rajaongkir.com/starter/province');

            $provinces = $response['rajaongkir']['results'];

            foreach ($provinces as $province) {
                $data_province[] = [
                    'id' => $province['province_id'],
                    'province' => $province['province'],
                ];
            }

            Province::insert($data_province);
        }
    }
}
