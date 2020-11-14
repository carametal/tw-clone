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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');

Route::match(['get', 'post'],'/user/{id}', [App\Http\Controllers\UsersController::class, 'user'])->name('user');

route::match(['post'], '/tweet', [App\Http\Controllers\TweetController::class, 'tweet'])->name('tweet');

route::match(['get'], '/timeline/{id}', [App\Http\Controllers\TweetController::class, 'timeline'])->name('timeline');

route::match(['get'], '/tweets-detail/{id}', [App\Http\Controllers\UsersDetailController::class, 'get'])->name('tweets-detail');

route::match(['post', 'delete'], '/follows', [App\Http\Controllers\FollowsController::class, 'follow'])->name('follow');

route::resource('favorites', App\Http\Controllers\FavoritesController::class)->only(['store', 'destroy']);