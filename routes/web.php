<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DioceseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonRoleAssignmentController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Test route - no middleware needed
Route::get('/', function () {
    return response()->json([
        'message' => 'Laravel Association Manager API',
        'version' => '1.0',
        'status' => 'active'
    ]);
});

Route::middleware(['web'])->group(function () {
    Route::resource('persons', PersonController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('associations', AssociationController::class);
    Route::resource('dioceses', DioceseController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('person-role-assignments', PersonRoleAssignmentController::class);
    Route::resource('media', MediaController::class)->only(['index', 'store', 'show', 'destroy']);
});
