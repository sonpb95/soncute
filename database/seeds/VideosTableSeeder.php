<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('videos')->delete();
      $faker = Faker\Factory::create();

      for($i = 1; $i < 1000; $i++) {
        App\Video::create([
          'id' => $i,
          'campaign_id' => $faker->numberBetween($min = 1, $max = 2000),
          'link' => $faker->imageUrl($width = 552, $height = 411),
          'delete_flag' => 0,
          'upload_at' => $faker->dateTime($max = 'now', $timezone = null)
        ]);
      }
    }
}
