<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	  $faker = Faker\Factory::create();
      DB::table('users')->delete();

      DB::table('users')->insert([
          'id' => 1,
          'name' => 'tuan',
          'password' => '$2y$10$J/iz/boNrn.BSQBSkbsgMuRi4TxVq/FTizoKNO21yuOUpbNQGNMJG',
          'email' => 'tuan@yopmail.com',
		  'biography' => $faker->sentence($nbWords = 6, $variableNbWords = true),
          'delete_flag' => 0,
          //'created_at' => date('Y-m-d H:i:s'),
          //'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'id' => 2,
          'name' => 'son',
          'password' => '$2y$10$J/iz/boNrn.BSQBSkbsgMuRi4TxVq/FTizoKNO21yuOUpbNQGNMJG',
          'email' => 'son@yopmail.com',
		  'biography' => $faker->sentence($nbWords = 6, $variableNbWords = true),
          'delete_flag' => 0,
          //'created_at' => date('Y-m-d H:i:s'),
          //'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'id' => 3,
          'name' => 'kha',
          'password' => '$2y$10$J/iz/boNrn.BSQBSkbsgMuRi4TxVq/FTizoKNO21yuOUpbNQGNMJG',
          'email' => 'kha@yopmail.com',
		  'biography' => $faker->sentence($nbWords = 6, $variableNbWords = true),
          'delete_flag' => 0,
          //'created_at' => date('Y-m-d H:i:s'),
          //'updated_at' => date('Y-m-d H:i:s'),
      ]);

        

        for($i = 4; $i < 1000; $i++) {
          App\User::create([
            'id' => $i,
            'name' => $faker->firstName($gender ='male'|'female'),
            'password' => '$2y$10$J/iz/boNrn.BSQBSkbsgMuRi4TxVq/FTizoKNO21yuOUpbNQGNMJG',
            'email' => $faker->freeEmail,
			'biography' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'delete_flag' => 0,
            //'created_at' => date('Y-m-d H:i:s'),
            //'updated_at' => date('Y-m-d H:i:s'),
          ]);
        }
      }
}
