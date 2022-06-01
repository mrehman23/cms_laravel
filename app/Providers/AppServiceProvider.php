<?php

namespace App\Providers;

use App\Http\Services\SettingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.*','admin.*'], function ($view) {
            $settingSvc = new SettingService();
            foreach($settingSvc->fetchAllKeys() as $setting) {
                // $key=$setting->key;
                // $data = Cache::remember($setting->key, 10800, function () use($settingSvc,$key){
                //     return $settingSvc->fetchValueByKey(str_replace('settings-', '', $key));
                // });
                $view->with($setting->key, $setting);
            }
        });
    }
}
