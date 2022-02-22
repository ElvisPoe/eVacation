<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::resource('users', UsersController::class)
    ->can('viewAny', \App\Models\User::class);

Route::get('applications', [ApplicationController::class, 'index'])
    ->name('applications.index')
    ->can('viewAny', \App\Models\Application::class);

Route::get('applications/{application}/{status}', [ApplicationController::class, 'setStatus'])
    ->can('update', \App\Models\Application::class);

Route::get('applications/create', [ApplicationController::class, 'create'])->name('applications.create');

Route::post('applications/store', [ApplicationController::class, 'store'])->name('applications.store');

require __DIR__.'/auth.php';
