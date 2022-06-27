<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware('auth')->group(function (){

    // General Routes
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Users Routes
    Route::get('applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('applications/store', [ApplicationController::class, 'store'])->name('applications.store');
});

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('users', UsersController::class);
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}/{status}', [ApplicationController::class, 'setStatus']);
});

require __DIR__.'/auth.php';
