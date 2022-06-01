<?php

use App\Http\Services\SettingService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'title' => 'Title',
                'key' => 'slug',
                'value' => 'KD CMS',
            ),
            array(
                'title' => 'Logo',
                'key' => 'web_logo',
                'value' => 'kd/logo.png',
            ),
            array(
                'title' => 'Per Page Listing',
                'key' => 'per_page_listing',
                'value' => '10',
            ),
            array(
                'title' => 'Home Keywords',
                'key' => 'keywords_home',
                'value' => 'kd_cms',
            ),
            array(
                'title' => 'About Keywords',
                'key' => 'keywords_about',
                'value' => 'kd_cms',
            ),
            array(
                'title' => 'Services Keywords',
                'key' => 'keywords_services',
                'value' => 'kd_cms',
            ),
            array(
                'title' => 'Contact Keywords',
                'key' => 'keywords_contact',
                'value' => 'kd_cms',
            ),
        );

        foreach ($data as $d) {
            extract($d);
            $service = new SettingService();
            if($service->fetchByKey($key))
                continue;
            $service->create($d);
            Cache::forever('settings-'.$key, $value);
        }
    }
}
