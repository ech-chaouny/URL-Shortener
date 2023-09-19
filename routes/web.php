<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('auth');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'auth'])->name('login');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('register');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
//show the shorten url
Route::get('visit/{shortner_link}', [LinkController::class, 'show']);
