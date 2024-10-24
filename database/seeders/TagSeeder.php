<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();

    // Générer 20 tags aléatoires
    for ($i = 0; $i < 20; $i++) {
      Tag::create([
        'name' => $faker->word, // Génère un mot aléatoire pour le nom du tag
      ]);
    }
  }
}
