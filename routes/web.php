<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('events/',[\App\Http\Controllers\EventController::class, "index"])->name("events.index");
Route::post('events/', [\App\Http\Controllers\EventController::class, "store"])->name("events.store");

Route::get('events/create', [\App\Http\Controllers\EventController::class, "create"])->name("events.create");

Route::get('/events/edit/{id}', [\App\Http\Controllers\EventController::class, 'edit'])->name("events.edit");

Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'update'])->name("events.update");

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name("events.index");
Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'show'])->name("events.show");
Route::delete('events/{id}', [\App\Http\Controllers\EventController::class, 'destroy'])->name("events.destroy");

Route::middleware('guest')->group(function (){
    Route::get('/register',[AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');

    Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',[AuthController::class, 'login'])->name('login.post')  ;
});

Route::middleware('auth')->group(function (){
   Route::get('/dashboard',[ProfileController::class, 'dashboard'])->name('dashboard');
   Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

   Route::get('role-requests/create', [RoleRequestController::class, 'create'])->name('role_requests.create');
   Route::post('role-requests', [RoleRequestController::class, 'store'])->name('role_requests.store');

});
