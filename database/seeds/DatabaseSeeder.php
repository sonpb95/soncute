<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
         //$this->call(UserDetailsTableSeeder::class);
         //$this->call(CreditCardsTableSeeder::class);
         //$this->call(CategoriesTableSeeder::class);
         //$this->call(CampaignsTableSeeder::class);
         //$this->call(PhotosTableSeeder::class);
         //$this->call(VideosTableSeeder::class);
         //$this->call(PerksTableSeeder::class);
         //$this->call(ContributionsTableSeeder::class);
         //$this->call(StaffPicksTableSeeder::class);
         $this->call(AddStatusSeeder::class); 
    }
}
