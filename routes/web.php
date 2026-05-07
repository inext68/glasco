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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('guest');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('persons', PersonWebController::class);
    Route::post('/persons/{person}/contacts', [PersonWebController::class, 'addContact'])->name('persons.addContact');
    Route::delete('/persons/{person}/contacts/{contact}', [PersonWebController::class, 'removeContact'])->name('persons.removeContact');
    Route::resource('contacts', ContactWebController::class);
    Route::resource('associations', AssociationWebController::class);
    Route::resource('dioceses', DioceseWebController::class);
    Route::resource('groups', GroupWebController::class);
    Route::post('/groups/{group}/associations', [GroupController::class, 'attachAssociation'])->name('groups.attachAssociation');
    Route::delete('/groups/{group}/associations/{association}', [GroupController::class, 'detachAssociation'])->name('groups.detachAssociation');
    Route::post('/groups/{group}/persons', [GroupController::class, 'attachPerson'])->name('groups.attachPerson');
    Route::delete('/groups/{group}/persons/{person}', [GroupController::class, 'detachPerson'])->name('groups.detachPerson');
    Route::resource('roles', RoleWebController::class);
    Route::resource('person-role-assignments', PersonRoleAssignmentWebController::class, ['names' => 'person-role-assignments']);
    Route::resource('media', MediaWebController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import', [ImportController::class, 'import'])->name('import.store');
    Route::get('/import/template', [ImportController::class, 'download'])->name('import.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/role-assignments/entities', [PersonRoleAssignmentWebController::class, 'entities']);
Route::get('/media/entities', [MediaWebController::class, 'entities']);