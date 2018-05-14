<?php

use Illuminate\Database\Seeder;

class AddStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      DB::table('campaigns')->update([
         'status' => '1',
      ]);
    }
}
