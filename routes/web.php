<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TheatreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CinemaBranchController;
use App\Http\Controllers\Admin\TheatreAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\ExcelController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/branches/{branch}/theatres', [TheatreController::class, 'index'])
    ->name('branches.theatres.index');

Route::get('/branches/{branch}/theatres/{theatre}', [TheatreController::class, 'show'])
    ->name('branches.theatres.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ✅ USER dashboard (ทุกคนที่ login เข้าได้)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('branches', CinemaBranchController::class);
        Route::resource('theatres', TheatreAdminController::class);

        Route::get('users', [UserAdminController::class, 'index'])
            ->name('users.index');

        Route::patch('users/{user}/role', [UserAdminController::class, 'updateRole'])
            ->name('users.updateRole');

        Route::delete('users/{user}', [UserAdminController::class, 'destroy'])
            ->name('users.destroy');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/excel', [ExcelController::class, 'index'])->name('admin.excel');
    Route::get('/admin/excel/export', [ExcelController::class, 'export'])->name('admin.excel.export');
    Route::post('/admin/excel/import', [ExcelController::class, 'import'])->name('admin.excel.import');
    });

    Route::post('/branches/{branch}/favorite', [HomeController::class, 'toggleFavorite'])
    ->name('branches.favorite')
    ->middleware('auth');
    
require __DIR__.'/auth.php';
