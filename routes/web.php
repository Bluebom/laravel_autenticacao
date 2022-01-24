<?php

use App\Http\Controllers\AutheticationController;
use App\Http\Controllers\HomePage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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
    return view('welcome');
});
Route::get('/home', HomePage::class)->name('home');
Route::get('/entrar', [AutheticationController::class,'login'])->name('login.form');
Route::post('/entrar', [AutheticationController::class,'logar'])->name('login');
Route::post('/sair', [AutheticationController::class, 'logout'])->name('logout');
Route::get('/registrar', [RegisterController::class,'create']);
Route::post('/registrar', [RegisterController::class,'store'])->name('register');

