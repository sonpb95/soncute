<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('contributions')->delete();

        $faker = Faker\Factory::create();

        for($i = 1; $i < 20000; $i++) {
          App\Contribution::create([
            'id' => $i,
            'user_id' => $faker->numberBetween($min = 1, $max = 999),
            'date' => $faker->dateTime($max = 'now', $timezone = null),
            'campaign_id' => $faker->numberBetween($min = 1, $max = 2000),
            'perk_id' => $faker->numberBetween($min = 1, $max = 24999),
          ]);
        }
      }
}
