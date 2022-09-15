<?php

use App\Http\Controllers\MainController;
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

Route::group(['middleware' => ['authcheck']], function () {
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    Route::get('/admin/dashboard', [MainController::class, 'dashboard'])->name('admin.dashboard');
});
Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');

//forget password request
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

//telling reset email 
Route::post('/forgot-password', [MainController::class, 'resetEmail'])->name('send-mail');
//link clicked
Route::get('/reset-password/{token}', [MainController::class, 'resetpasswordform'])->name('reset.password.get');
Route::post('/reset-password', [MainController::class, 'submitresetpassword'])->name('reset.password.post');
