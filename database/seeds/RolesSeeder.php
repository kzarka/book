<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
    		"name" => "Administrator",
    		"slug" => "admin",
		    "permissions" => [
		        "user.create" => true,
		        "user.delete" => true,
		        "user.view"   => true,
		        "user.update" => true
		    ]
		];

		$mod = [
		    "name" => "Moderator",
		    "slug" => "mod",
		    "permissions" => [
		        "user.create" => false,
		        "user.delete" => false,
		        "user.view"   => true,
		        "user.update" => true
		    ]
		];

		Sentinel::getRoleRepository()->createModel()->create($admin);
		Sentinel::getRoleRepository()->createModel()->create($mod);
    }
}
