<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\App;
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

Route::get('/', [App\Http\Controllers\SoundController::class, 'allCategories'])->middleware('block_check');

//Route::prefix('{locale}')->group(function ($locale) {
//    App::setLocale($locale);
    Route::get('/main', [App\Http\Controllers\SoundController::class, 'allCategories'])->name('main');
//});

Route::prefix('Dashboard')->middleware('is_admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Dashboard\AdminController::class, 'showDashboard'])
        ->name('dashboard');
    Route::post('/dashboard', [App\Http\Controllers\Dashboard\AdminController::class, 'action'])
        ->name('dashboard');
    Route::get('/complaints', [App\Http\Controllers\Dashboard\AdminController::class, 'showComplaints'])
        ->name('complaints');
    Route::get('/complaints.all', [App\Http\Controllers\Dashboard\AdminController::class, 'showAllComplaints'])
        ->name('complaints.all');
    Route::post('/complaints', [App\Http\Controllers\Dashboard\AdminController::class, 'actionComplaints'])
        ->name('complaints');
    Route::get('/categories', [App\Http\Controllers\Dashboard\AdminController::class, 'showCategories'])
        ->name('categories');
    Route::post('/categories', [App\Http\Controllers\Dashboard\AdminController::class, 'actionCategories'])
        ->name('categories');
    Route::get('/users', [App\Http\Controllers\Dashboard\AdminController::class, 'showUsers'])
        ->name('users');
    Route::post('/users', [App\Http\Controllers\Dashboard\AdminController::class, 'actionUsers'])
        ->name('users');
    Route::get('/addusers', [App\Http\Controllers\Dashboard\AdminController::class, 'addUsers'])
        ->name('addusers');
    Route::post('/addusers', [App\Http\Controllers\Dashboard\AdminController::class, 'addUser'])
        ->name('addusers');
});


Route::post('/add', [\App\Http\Controllers\SoundController::class, 'addSound']);
Route::get('/search/{id}', [\App\Http\Controllers\SoundController::class, 'searchByCategory']);
Route::get('/search', [\App\Http\Controllers\SoundController::class, 'searchByName']);
Route::post('search/complaint', [\App\Http\Controllers\SoundController::class, 'complaint'])->name('complaint');

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
});
