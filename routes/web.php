<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssociationWebController;
use App\Http\Controllers\ContactWebController;
use App\Http\Controllers\DioceseWebController;
use App\Http\Controllers\GroupWebController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MediaWebController;
use App\Http\Controllers\PersonWebController;
use App\Http\Controllers\PersonRoleAssignmentWebController;
use App\Http\Controllers\RoleWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('guest');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('persons', PersonWebController::class);
    Route::resource('contacts', ContactWebController::class);
    Route::resource('associations', AssociationWebController::class);
    Route::resource('dioceses', DioceseWebController::class);
    Route::resource('groups', GroupWebController::class);
    Route::resource('roles', RoleWebController::class);
    Route::resource('person-role-assignments', PersonRoleAssignmentWebController::class);
    Route::resource('media', MediaWebController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});