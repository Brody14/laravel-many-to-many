<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::create([
            'name' => 'Stefania Spina',
            'email' => 'stefania.spinas@gmail.com',
            'password' => Hash::make('stefania'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'password' =>  Hash::make($faker->password(2, 8)),
            ]);
        }
    }
}
