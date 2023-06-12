<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

Route::get('show/{id}', function ($image = 'ss') {
    $path = $image;

    $imageContents = Storage::disk('s3')->get($path); // Recupera o conteúdo da imagem

    return Response::make($imageContents, 200, [
        'Content-Type' => 'image/jpeg',
        'Content-Disposition' => 'inline; filename="imagem.jpg"',
    ]);
})->name('show.image');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
