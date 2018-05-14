<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('perks')->delete();
      $faker = Faker\Factory::create();

      for($i = 1; $i < 25000; $i++) {
        App\Perk::create([
          'id' => $i,
          'campaign_id' => $faker->numberBetween($min = 1, $max = 2000),
          'price' => $faker->numberBetween($min = 10, $max = 5000),
          'retail_price' => $faker->numberBetween($min = 1, $max = 999),
          'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
          //'included_items' => $faker->numberBetween($min = 0, $max = 1),
          'description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
          //'photo_id' => $faker->numberBetween($min = 1, $max = 999),
          'total_quantily' => $faker->numberBetween($min = 1, $max = 99),
          'estimated_delivery_date' => $faker->dateTime($max = 'now', $timezone = null),
          'ship' => $faker->numberBetween($min = 0, $max = 1),
          'buy_number' => $faker->numberBetween($min = 1, $max = 99),
          'delete_flag' => 0,
          'created_at' => $faker->dateTime($max = 'now', $timezone = null),
          'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
        ]);
      }
    }
}
