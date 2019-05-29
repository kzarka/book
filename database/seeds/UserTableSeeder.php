<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $credentials = [
            'first_name' => 'Admin', 
            'email' => 'admin@gmail.com', 
            'password' => 'anh123'
        ];
        
        $user = Sentinel::registerAndActivate($credentials);
        $role = Sentinel::findRoleBySlug('admin');
        $user->roles()->attach($role);
    }
}
