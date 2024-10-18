<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\DashboardController as AdminDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about ', function () {
    return view('about', ['Nama' => 'Dillah']);
});

Route::get('/see ', function () {
    return view('see');
});

Route::get('/Blog ', function () {
    return view('Blog');
});

Route::get('/contact ', function () {
    return view('Contact');
});


 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/admin', [UserController::class, 'index'])->name('user.index');
 
Route::group(['prefix' => 'admin/user'], function () {
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/add', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
});

// Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('users');

