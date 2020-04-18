<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //Route Category
    Route::get('/category', 'CategoryController@index')->name('category.list');
    Route::post('/category/save', 'CategoryController@store')->name('category.save');
    Route::post('/category/edit', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/update', 'CategoryController@update')->name('category.update');
    Route::post('/category/delete', 'CategoryController@destroy')->name('category.delete');

    //Route Videos Category
    Route::get('/videocategory', 'VideoCategoryController@index')->name('videocategory.list');
    Route::post('/videocategory/save', 'VideoCategoryController@store')->name('videocategory.save');
    Route::post('/videocategory/edit', 'VideoCategoryController@edit')->name('videocategory.edit');
    Route::post('/videocategory/update', 'VideoCategoryController@update')->name('videocategory.update');
    Route::post('/videocategory/delete', 'VideoCategoryController@destroy')->name('videocategory.delete');

    //Route Videos Category
    Route::get('/videos', 'VideoController@index')->name('videos.list');
    Route::post('/videos/save', 'VideoController@store')->name('videos.save');
    Route::post('/videos/edit', 'VideoController@edit')->name('videos.edit');
    Route::post('/videos/update', 'VideoController@update')->name('videos.update');
    Route::post('/videos/delete', 'VideoController@destroy')->name('videos.delete');

    //Route Subscribe User
    Route::get('/subscribeuser', 'VideoSubscribeController@index')->name('subscribe.user');
    Route::get('/pdf', 'VideoSubscribeController@viewpdf')->name('pdf');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route User Videos Category
Route::get('/free', 'VideoSubscribeController@free')->name('free');
Route::get('/subscribe', 'VideoSubscribeController@subscribe')->name('subscribe');
Route::get('/details/{id}', 'VideoSubscribeController@details')->name('details');
Route::get('/usersubscribelist', 'VideoSubscribeController@usersubscribelist')->name('usersubscribelist');
Route::get('/likevideos', 'VideoSubscribeController@likevideos')->name('likevideos');
Route::post('/videosubscribe', 'VideoSubscribeController@usersubscribe')->name('user.subscribe');
Route::post('/like', 'VideoSubscribeController@userlike')->name('user.like');