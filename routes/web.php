<?php

// use App\Http\Controllers\WebSiteController;
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


// Route::post('/about', WebSiteController::class);


Route::get('/', 'WebSiteController@index')->name('home');
Route::get('/about', 'WebSiteController')->name('about');
Route::get('/our-brands', 'WebSiteController')->name('our-brands');
Route::get('/services', 'WebSiteController')->name('services');
Route::get('/contact', 'WebSiteController')->name('contact');
// Route::get('/about', 'WebSiteController@about')->name('about');
// Route::get('/our-brands', 'WebSiteController@our-brands')->name('our-brands');
// Route::get('/services', 'WebSiteController@services')->name('services');
// Route::get('/contact', 'WebSiteController@contact')->name('contact');

Auth::routes();

Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function(){
    Route::get('home', 'PagesController@index')->name('home');
    Route::get('notification', 'PagesController@index')->name('notification');
    // Route::get('home', 'DashboardController@index')->name('home');
    Route::resource('settings', 'SettingController')->only(['index', 'store']);

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
