<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();

            
        $companies = \App\Models\Company::all();
        $rooms = \App\Models\Room::all();

        foreach ($users as $key => $user) {
            foreach ($rooms as $key => $room) {
                for ($i=0; $i < 10; $i++) { 
                    \App\Models\People::create([
                        'user_id' => $user->id,
                        'room_id' => $room->id,
                        'company_id' => rand(0, $companies->count()),
                        'name' => 'Demo Name '. $i,
                        'indentity' => 'DP'.rand(5000, 7000).'Y',
                    ]);
                }
            }
        }
        
                   
    }

}