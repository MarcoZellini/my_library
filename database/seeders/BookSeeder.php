<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Generator as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 200; $i++) {
            Book::create([
                'user_id' => rand(1, 10),
                'title' => $faker->sentence(),
                'author' => $faker->name(),
                'cover_image' => 'https://unsplash.it/600/400?image=' . rand(1, 1000),
                'isbn' => $faker->isbn13(),
                'plot' => $faker->text(),
            ]);
        }
    }
}
