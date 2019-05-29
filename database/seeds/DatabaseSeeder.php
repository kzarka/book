<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('UserTableSeeder');
        $this->call('ClassesTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('ImagesTableSeeder');
        $this->call('BossDataSeeder');
        $this->command->info('Data table seeded!');
    }
}
