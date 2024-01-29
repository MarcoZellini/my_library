<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@library.it'
        ]);

        for ($i = 0; $i < 10; $i++) {

            $firstName = strtolower($faker->firstName());
            $lastName = strtolower($faker->lastName());

            User::create([
                'name' => ucfirst($firstName),
                'lastname' => ucfirst($lastName),
                'email' => $firstName . '.' . $lastName . '@library.it'
            ]);
        }
    }
}
