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
<<<<<<< HEAD
});
Route::post('/', [AuthController::class, 'auth']);
=======
})->name('home');

//Route::post('/', [AuthController::class, 'auth']);
>>>>>>> ddb9627 (updated)


Route::post('/add', [\App\Http\Controllers\SoundController::class, 'addSound']);
Route::get('/show', [\App\Http\Controllers\SoundController::class, 'soundSearch']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
<<<<<<< HEAD
=======

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
>>>>>>> ddb9627 (updated)
