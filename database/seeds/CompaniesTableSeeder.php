<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
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
                    \App\Models\Company::create([
                        'user_id' => $user->id,
                        'name' => 'Demo Company Name '.$i. ' Pte Ltd',
                        'regi_no' => 'Q'.rand(50000, 70000).'M',
                        'address' => 'Demo address',
                        'email' => $i.'email@admin.com',
                        'phone' => (int)'006598472'.$i
                    ]);
                }
            }
        }
    }
}
