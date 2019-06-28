<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Carbon\Carbon;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'name'=>'admin',
            'email' => 'admin@gmail.com',
            'password'=>Hash::make('11111111'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }
}
