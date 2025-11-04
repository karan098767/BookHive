<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public: simple home that navigates to books
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Books / search
Route::resource('books', BookController::class);

// Authors
Route::resource('authors', AuthorController::class);

// Members (admin-managed)
Route::resource('members', MemberController::class);

// Borrow tracker
Route::resource('borrow', BorrowController::class)->parameters(['borrow' => 'borrowTracker']);

// Admin simple auth
Route::get('admin/login', [AuthController::class,'showLogin'])->name('admin.login');
Route::post('admin/login', [AuthController::class,'login'])->name('admin.login.post');
Route::post('admin/logout', [AuthController::class,'logout'])->name('admin.logout');

// Admin group (simple session guard)
Route::middleware(['web'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
});
