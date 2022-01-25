<?php

use App\Http\Controllers\AutheticationController;
use App\Http\Controllers\HomePage;
use App\Http\Controllers\PasswordResetController;
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

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/home', HomePage::class)->name('home');
    Route::post('/sair', [AutheticationController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function()
{
    Route::get('/entrar', [AutheticationController::class,'login'])->name('login.form');
    Route::post('/entrar', [AutheticationController::class,'logar'])->name('login');
    Route::get('/registrar', [RegisterController::class,'create']);
    Route::post('/registrar', [RegisterController::class,'store'])->name('register');
    Route::get('/esqueceu-senha', [PasswordResetController::class,'request'])->name('password.request');
    Route::post('/esqueceu-senha', [PasswordResetController::class, 'email'])->name('password.email');
    Route::get('/recuperar-senha', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/recuperar-senha', [PasswordResetController::class, 'update'])->name('password.update');

});
Route::get('/home', HomePage::class)->name('home')->middleware('auth');