<?php

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Categories::create(['name' => 'News', 'active' => 1, 'slug' => 'news']);
        Categories::create(['name' => 'Guides', 'active' => 1, 'slug' => 'guides']);
        Categories::create(['name' => 'Lifeskill', 'active' => 1, 'parent_id' => '2', 'slug' => 'life-skill']);
        Categories::create(['name' => 'Nhân Vật', 'active' => 1, 'parent_id' => '2', 'slug' => 'classes']);
        Categories::create(['name' => 'Game', 'active' => 1, 'parent_id' => '2', 'slug' => 'game-guides']);
    }
}
