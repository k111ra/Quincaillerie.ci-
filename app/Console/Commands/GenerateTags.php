<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class GenerateTags extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'generate:tags {count=10}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate random tags';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $count = $this->argument('count');
    $faker = Faker::create();

    for ($i = 0; $i < $count; $i++) {
      $name = $faker->word;

      Tag::create([
        'name' => $name,
        'slug' => Str::slug($name),
      ]);
    }

    $this->info("Successfully generated {$count} tags.");
    return 0;
  }
}
