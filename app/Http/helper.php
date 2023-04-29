<?php

use App\Http\Services\PagesService;
use Illuminate\Support\Facades\Cache;

function notifications()
{
    // $sid = (!empty(\Illuminate\Support\Facades\Auth::user()->std_id) ? \Illuminate\Support\Facades\Auth::user()->std_id : 0);
    // $notifications =  DB::select('select n.notify_id , n.NOTIFY_TITLE, n.NOTIFY_DESC, n.START_DATE, n.END_DATE , f.STATUS from PORTAL_NOTIFICATION n , portal_notification_for f where n.notify_id = f.notify_id  and f.notify_for_id = '.$sid.' and f.STATUS = 1');
    return [];
}

function menuList() {
    $key = 'pages-menu-list-'.getSelectedLang();
    return Cache::remember($key, 10800, function () use($key){
        $pagesSvc = new PagesService();
        return  $pagesSvc->fetchPagesForMenu();
    });
}

function StatusLov() {
    return ['ACTIVE'=>'ACTIVE','INACTIVE'=>'INACTIVE'];
}

function LanguagesList() {
    return ['en'=>'EN','ar'=>'AR'];
}

function ProcessFlow() {
    return ['PENDING'=>'PENDING','APPROVED'=>'APPROVED','PROCESSED'=>'PROCESSED','COMPLETED'=>'COMPLETED','CANCELLED'=>'CANCELLED'];
}

function isSelected($option,$selected) {
    return (($option === $selected) ? "selected" : "");
}

function getSelectedLang() {
    return app()->getLocale();
}

function get_lang_change_url() {
    $url = redirect()->back()->getTargetUrl();
    $seg = get_segments($url);
    $routeName =app('router')->getRoutes()->match(app('request')->create($url))->getName();
    if($routeName=='page') {
        return route($routeName,[getSelectedLang(),end($seg)]);
    } else {
        return route('home');
    }
}

function get_segments($uri) {
    $segments = explode('/', str_replace(''.url('').'', '', $uri));
    return array_values(array_filter($segments, function ($value) {
        return $value !== '';
    }));
}
