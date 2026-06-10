<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::put('/events/{id}', [EventController::class, 'update'])->name("events.update");
Route::patch('/events/{id}', [EventController::class, 'update'])->name("events.update.patch");

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name("events.index");
Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'show'])->name("events.show");
Route::delete('events/{id}', [\App\Http\Controllers\EventController::class, 'destroy'])->name("events.destroy");

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/attachments', [AttachmentController::class, 'store'])
        ->name('events.attachments.store');

    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('attachments.destroy');

    Route::get('/attachments/{attachment}/download', [AttachmentController::class, 'download'])
        ->name('attachments.download');
});


Route::middleware('guest')->group(function (){
    Route::get('/register',[AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');

    Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',[AuthController::class, 'login'])->name('login.post')  ;
});

Route::middleware('auth')->group(function (){
   Route::get('/dashboard',[ProfileController::class, 'dashboard'])->name('dashboard');
   Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

   Route::get('role-requests/create', [RoleRequestController::class, 'create'])->name('role-requests.create');
   Route::post('role-requests', [RoleRequestController::class, 'store'])->name('role_requests.store');

});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/requests', [App\Http\Controllers\Admin\AdminRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{roleRequest}', [App\Http\Controllers\Admin\AdminRequestController::class, 'show'])->name('requests.show');

    Route::put('/requests/{roleRequest}/approve', [App\Http\Controllers\Admin\AdminRequestController::class, 'approve'])->name('requests.approve');
    Route::put('/requests/{roleRequest}/reject', [App\Http\Controllers\Admin\AdminRequestController::class, 'reject'])->name('requests.reject');

    Route::get('/users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('users.show');
});
