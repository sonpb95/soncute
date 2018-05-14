<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('credit_cards')->delete();
      $faker = Faker\Factory::create();

      for($i = 1; $i < 1000; $i++) {
        App\CreditCard::create([
          'id' => $i,
          'user_id' => $faker->numberBetween($min = 1, $max = 4),
          'card_number' => $faker->creditCardNumber,
          'cardholder_name' => $faker->name,
          'expiration_date' => $faker->creditCardExpirationDate,
          'security_code' => $faker->randomNumber($nbDigits = 6, $strict = false),
          'delete_flag' => 0,
          'created_at' => $faker->dateTime($max = 'now', $timezone = null),
          'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
        ]);
      }
    }
}
