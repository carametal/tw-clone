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

Route::get('/env', function () {
    return env('APP_NAME');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', App\Http\Controllers\UsersController::class)->only(['index', 'show']);

Route::resource('user-profiles', App\Http\Controllers\UserProfilesControler::class)->only(['show', 'update']);

Route::resource('tweets', App\Http\Controllers\TweetController::class)->only(['store', 'destroy']);

route::resource('timeline', App\Http\Controllers\TimelineController::class)->only(['show']);

route::match(['get'], '/tweets-detail/{id}', [App\Http\Controllers\UsersDetailController::class, 'get'])->name('tweets-detail');

route::resource('follows', App\Http\Controllers\FollowsController::class)->only(['store', 'destroy']);

route::resource('favorites', App\Http\Controllers\FavoritesController::class)->only(['store', 'destroy']);

Route::resource('follow-list', App\Http\Controllers\FollowListController::class)->only(['show']);

Route::resource('follower-list', App\Http\Controllers\FollowerListController::class)->only(['show']);

route::get('/info', function() {
    return phpinfo();
});