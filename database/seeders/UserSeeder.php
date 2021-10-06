<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        if ($users->count() == 0) {
            $user = [
                [
                    'name' => 'Kelvin Oktavian',
                    'email' => 'kelvin15102000@gmail.com',
                    'username' => 'kelvinoktavian_',
                    'is_admin' => '1',
                    'has_address' => '0',
                    'phone' => '895345228535',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'name' => 'Anonymous User',
                    'email' => 'user@gmail.com',
                    'username' => 'user_testing',
                    'is_admin' => '0',
                    'has_address' => '0',
                    'phone' => '895345228536',
                    'password' => bcrypt('12345678'),
                ],
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }

            \App\Models\User::factory(5)->create();
        }
    }
}
