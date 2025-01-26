<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\User\UserListController;
use App\Http\Controllers\Api\User\UserCreateController;
use App\Http\Controllers\Api\User\UserEditController;
use App\Http\Controllers\Api\User\UserDeleteController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});

//Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// User routes
Route::get('/users', [UserListController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserCreateController::class, 'create'])->name('users.create');
Route::post('/users', [UserCreateController::class, 'store'])->name('users.store');
Route::get('/users/{userId}/edit', [UserEditController::class, 'edit'])->name('users.edit');
Route::put('/users/{userId}', [UserEditController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserDeleteController::class, 'destroy'])->name('users.destroy');
