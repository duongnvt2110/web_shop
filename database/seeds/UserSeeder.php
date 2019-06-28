<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::create([
            'name' =>'test',
            'email' => 'test@gmail.com',
            'address'=> 'test1232131231',
            'phone_number'=>'086632123',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'), // password
            'confirmed'=>'1',
            'locked'=>'0',
            'last_activity'=>Carbon::now(),
            'remember_token' => Str::random(10),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        factory(User::class,20)->create();
    }
}
