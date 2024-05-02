<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\TestController;
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

Route::get('/user/dashboard', function () {
    return view('dashboardUser');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('dashboardAdmin');
})->middleware('admin');

Route::get('/calculation', function () {
    return view('calculation');
})->middleware('auth')->name('calculation');

Route::post('/calculation/logic', [CalculatorController::class, 'calculate'])->name('calculation.logic')->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/', [CalculatorController::class, 'calculate']);

Route::resource('test', TestController::class);
