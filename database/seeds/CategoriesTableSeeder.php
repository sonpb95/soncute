<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->delete();

      DB::table('categories')->insert([
          'id' => 1,
          'name' => 'Art'
      ]);

      DB::table('categories')->insert([
          'id' => 2,
          'name' => 'Comics'
      ]);

      DB::table('categories')->insert([
          'id' => 3,
          'name' => 'Craft'
      ]);

      DB::table('categories')->insert([
          'id' => 4,
          'name' => 'Design'
      ]);

      DB::table('categories')->insert([
          'id' => 5,
          'name' => 'Fashion'
      ]);

      DB::table('categories')->insert([
          'id' => 6,
          'name' => 'Film'
      ]);

      DB::table('categories')->insert([
          'id' => 7,
          'name' => 'Food'
      ]);

      DB::table('categories')->insert([
          'id' => 8,
          'name' => 'Games'
      ]);

      DB::table('categories')->insert([
          'id' => 9,
          'name' => 'Journalistm'
      ]);

      DB::table('categories')->insert([
          'id' => 10,
          'name' => 'Music'
      ]);

      DB::table('categories')->insert([
          'id' => 11,
          'name' => 'Photography'
      ]);

      DB::table('categories')->insert([
          'id' => 12,
          'name' => 'Publishing'
      ]);

      DB::table('categories')->insert([
          'id' => 13,
          'name' => 'Technology'
      ]);

      DB::table('categories')->insert([
          'id' => 14,
          'name' => 'Theater'
      ]);

      DB::table('categories')->insert([
          'id' => 15,
          'name' => 'Other'
      ]);
    }
}
