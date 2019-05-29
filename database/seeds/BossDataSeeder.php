<?php

use Illuminate\Database\Seeder;
use App\Models\BossData;

class BossDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BossData::create(['data' => 'sample']);
    }
}
