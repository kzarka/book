<?php

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->delete();
        $classList = [
        	'Striker',
        	'Mystic',
        	'Witch',
        	'Wizard',
        	'Maehwa',
        	'Musa',
        	'Ninja',
        	'Kunoichi',
        	'Valkyrie',
        	'Warrior',
        	'Ranger',
        	'Dark Knight',
        	'Sorceress',
        	'Tamer',
        	'Berserker',
        	'Lahn'
        ];

        foreach ($classList as $class) {
        	Classes::create(['name' => $class, 'active' => 1, 'has_awk' => 1]);
        }
        
    }
}
