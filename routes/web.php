<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\AccessUser\UserAccess;
use Illuminate\Support\Facades\Route;

// Al acceder al dashboard el middleware desvia a los no admin a moddleware
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', 'rol'])->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/', UserController::class)->name('dashboard');
    Route::post('generar-pdf/{user}', [UserController::class, 'generatePDF'])->name('generate-pdf');
    
});

// Cualquier solicitud del admin pasan y las que no son desviadas por el middleware
// Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function (){
   //Route::get('/usuarios', UserController::class)->name('users');
// });

// Los usuarios pueden acceder al registro
Route::middleware(['auth'])->group(function (){
    Route::get('control-acceso', UserAccess::class)->name('access-users');
});
