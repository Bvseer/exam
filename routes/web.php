<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('auth/register');
})->middleware('is_logged');

Route::match(['get', 'post'],'/main', [App\Http\Controllers\SoundController::class, 'allCategories'])
    ->middleware('user')->name('main');

Route::post('/', [AuthController::class, 'auth'])->name('home');

//Route::post('/', [AuthController::class, 'auth']);


Route::post('/add', [\App\Http\Controllers\SoundController::class, 'addSound']);
Route::get('/search/{id}', [\App\Http\Controllers\SoundController::class, 'searchByCategory']);
Route::get('/search', [\App\Http\Controllers\SoundController::class, 'searchByName']);
Route::post('/search/complaint', [\App\Http\Controllers\SoundController::class, 'complaint']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
