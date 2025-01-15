<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CreateCostumerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::resource('customers', CustomerController::class);;
Route::put('/customers/{customer}/update-status', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');
Route::resource('transactions', TransactionController::class);
Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');









Route::get('home', function () {
    return view('home');
})->middleware('auth');
