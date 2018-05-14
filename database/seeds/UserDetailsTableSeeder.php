<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user_details')->delete();

      DB::table('user_details')->insert([
          'id' => 1,
          'user_id' => 1,
          'avatar' => 'https://scontent.fhan3-2.fna.fbcdn.net/v/t1.0-9/24174494_1765906686753834_5468364882388223355_n.jpg?oh=92e393649f7c83c0945482ad5d0340b5&oe=5AD9E59E',
          'full_name' => 'Tran Quoc Tuan',
          'phone_number' => '01626405056',
          'country' => 'Vietnam',
          'city' => 'BacGiang',
          'postal_code' => 220000,
          'address' => '92 Le Lai street',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);

      $faker = Faker\Factory::create();

      for($i = 2; $i < 1000; $i++) {
        App\UserDetail::create([
          'id' => $i,
          'user_id' => $i,
          'avatar' => $faker->imageUrl($width = 300, $height = 300),
          'full_name' => $faker->name,
          'phone_number' => $faker->phoneNumber,
          'country' => $faker->country,
          'city' => $faker->city,
          'postal_code' => $faker->postcode,
          'address' => $faker->address,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }
}
