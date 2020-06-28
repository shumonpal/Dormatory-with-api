<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Model::unguard();
        // $this->call(UserSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
    }
}
