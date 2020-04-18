<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
    		'id' 				=> 1,
            'name' 				=> "Admin",
            'email' 			=> "admin@gmail.com",
            'password' 			=> bcrypt("admin@123"),
    	]);
    }
}
