<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// ----------------------- ACCUEIL -----------------------
Route::get('/', [MenusController::class, 'Accueil'])->name('accueil');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MenusController::class, 'Dashboard'])->name('dashboard');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');








    // Admin Routes - Protégées par le middleware admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
         Route::get('/dashboard', [MenusController::class, 'Dashboard'])->name('dashboard');
         Route::get('/drive/dashboard', [AdminController::class, 'DriveDashboard'])->name('drive.dashboard');

        // Route::resource('users', UserController::class);
        // Route::resource('buses', BusController::class);
        // Ajouter vos routes admin ici
    });
});
// ----------------------- PROFILE -----------------------

Route::middleware(['auth'])->group(function () {
   Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::put('/profile/change-password', [ProfileController::class, 'updatePassword'])
    ->name('profile.updatePassword');


});
