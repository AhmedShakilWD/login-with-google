<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PdfController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('auth/google',[GoogleController::class,'GoogleLogin'])->name('login');
Route::any('auth/google/callback',[GoogleController::class,'GoogleCallback'])->name('callback');
Route::get('/dashbord', function () {
    return view('dashboard');
});

// PDF Route
Route::get('/pdf',[PdfController::class,'index'])->name('pdf');