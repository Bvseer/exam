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
});
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome')->middleware('admin');

//Route::post('/', [AuthController::class, 'auth']);


Route::post('/add', [\App\Http\Controllers\SoundController::class, 'addSound']);
Route::get('/show', [\App\Http\Controllers\SoundController::class, 'soundSearch']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin')->middleware('admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
