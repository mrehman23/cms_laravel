<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('lang/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect(get_lang_change_url());
})->name('lang');

Route::get('/', function () {
    return redirect(route('langhome',getSelectedLang()));
})->name('home');


Route::get('/{lan}', 'WebSiteController@index')->name('langhome')->where('lan','(en|ar)');
Route::get('/{lang}/{name}', 'WebSiteController')->name('page')->where('name', implode('|',(menuList()->pluck('slug')->toArray())?:['/']));
Route::post('/contact', 'WebSiteController@contact')->name('contact');

Auth::routes();

Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function(){
    Route::get('home', 'PagesController@index')->name('home');
    Route::get('notification', 'PagesController@index')->name('notification');
    Route::resource('settings', 'SettingController')->only(['index', 'store']);
    Route::resource('templates', 'TemplateController')->only(['index', 'edit']);
    Route::post('/templates/{id}/edit','TemplateController@update')->name('templates.update');

    Route::group(['prefix'=>'profile'],function() {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('change-password', 'ProfileController@changePassword')->name('profile.changepassword');
    });

    Route::group(['prefix'=>'pages'],function() {
        Route::get('/','PagesController@index')->name('pages.index');
        Route::get('/create','PagesController@create')->name('pages.create');
        Route::post('/create','PagesController@store')->name('pages.store');
        Route::get('/edit/{id}','PagesController@edit')->name('pages.edit');
        Route::post('/edit','PagesController@update')->name('pages.update');
        Route::get('/delete/{id}','PagesController@delete')->name('pages.delete');
    });

    Route::group(['prefix'=>'posts'],function() {
        Route::get('/','PostsController@index')->name('posts.index');
        Route::get('/create','PostsController@create')->name('posts.create');
        Route::post('/create','PostsController@store')->name('posts.store');
        Route::get('/edit/{id}','PostsController@edit')->name('posts.edit');
        Route::post('/edit','PostsController@update')->name('posts.update');
        Route::get('/delete/{id}','PostsController@delete')->name('posts.delete');
    });

});

Route::get('logout', function () {
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
})->name('logout');

Route::get('clear_cache', function () {
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    return Redirect::to('/');
});
