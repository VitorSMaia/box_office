<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\GroupPermission;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    return view('welcome');
});

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('eventos','events')->middleware(['auth', 'verified'])->name('events');

Route::view('bilhetes', 'tickets')->middleware(['auth', 'verified'])->name('tickets');

Route::view('permissoes', 'permissions')->middleware(['auth', 'verified'])->name('permissions');

Route::view('usuarios', 'users')->middleware(['auth', 'verified'])->name('users');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
