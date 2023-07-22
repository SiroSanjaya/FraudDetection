<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

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

Route::get('', [PagesController::class, 'dashboard'])->name('dashboard');
Route::get('auth/google', [AuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [AuthController::class, 'callbackGoogle']);
Route::get('/login', [PagesController::class, 'Login'])->name('login');
Route::get('/select', [PagesController::class, 'SelectUnit'])->name('SelectUnit');
Route::post('/selected', [PagesController::class, 'SelectedUnit'])->name('SelectedUnit');
