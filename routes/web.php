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

Route::middleware(['auth'])->group(function () {
    Route::resource('horse', App\Http\Controllers\HorseController::class);
    Route::resource('better', App\Http\Controllers\BetterController::class);
    Route::get('better/{id}/info', [App\Http\Controllers\BetterController::class, 'info'])->name('better.info');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/{any}', function () {
    return view('errors/error-page');
})->where('any', '.*');
