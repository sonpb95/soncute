<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('campaigns')->delete();
      $faker = Faker\Factory::create();

      for($i = 1; $i <= 2000; $i++) {
        App\Campaign::create([
          'id' => $i,
          'category_id' => $faker->numberBetween($min = 1, $max = 15),
          'user_id' => $faker->numberBetween($min = 1, $max = 999),
          'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
          'goal' => $faker->numberBetween($min = 5000, $max = 200000),
          'tagline' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
          'avatar' => $faker->imageUrl($width = 292, $height = 204),
          'pitch' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
          'priority' => $faker->numberBetween($min = 0, $max = 999),
          'location' => $faker->streetAddress,
          'delete_flag' => 0,
          'created_at' => $faker->dateTime($max = 'now', $timezone = null),
          'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
          'start_at' => $faker->dateTime($max = 'now', $timezone = null),
          'end_at' => $faker->dateTime($max = 'now', $timezone = null)
        ]);
      }
    }
}
