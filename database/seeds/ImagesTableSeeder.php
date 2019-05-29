<?php

use Illuminate\Database\Seeder;
use App\Models\ImagesSetting;
class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images_setting')->delete();
        ImagesSetting::create(['name' => 'Logo', 'url' => '/images/logo.png', 'default_url' => '/images/default-logo.png']);
        ImagesSetting::create(['name' => 'Top Banner', 'url' => '/images/ads/default-banner-ads.jpg', 'default_url' => '/images/ads/default-banner-ads.jpg']);
        ImagesSetting::create(['name' => 'Sidebar Banner', 'url' => '/images/ads/default-sidebar-ads.jpg', 'default_url' => '/images/default-sidebar-ads.jpg']);
        ImagesSetting::create(['name' => 'Middle Banner', 'url' => '/images/ads/default-banner-ads.jpg', 'default_url' => '/images/ads/default-banner-ads.jpg']);
    }
}
