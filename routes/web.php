<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;

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

Route::get('/', [DashboardController::class,'index'])->name('dashboard');

Route::prefix('/conversation')->group(function () {
    Route::get('/',[ConversationController::class,'index'])->name('conversation');
});

Route::prefix('/message')->group(function () {
    Route::get('/',[MessageController::class,'index'])->name('message');
});
