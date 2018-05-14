<?php

use Illuminate\Database\Seeder;

class AddPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('campaigns')->update([
         'priority' => '1',
      ]);
    }
}
