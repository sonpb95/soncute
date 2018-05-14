<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffPicksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('staff_picks')->delete();
      $faker = Faker\Factory::create();

      for($i = 1; $i < 20000; $i++) {
        App\StaffPick::create([
          'campaign_id' => $faker->numberBetween($min = 1, $max = 2000),
          'category_id' => $faker->numberBetween($min = 1, $max = 15),
        ]);
      }
    }
}
