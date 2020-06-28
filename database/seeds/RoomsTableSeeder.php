<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();

        
        
        if ($count = $users->count() > 0) {
            foreach ($users as $key => $user) {
                
                for ($i=0; $i < 10; $i++) { 
                    \App\Models\Room::create([
                        'user_id' => $user->id,
                        'room_no' => rand(1, 5).'#'.rand(1, 6),
                        'capability' => rand(10, 12),
                    ]);
                                        
                }
            }
        }
    }
}
