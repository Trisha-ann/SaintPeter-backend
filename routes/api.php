<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Public API
Route::post('/login', [AuthController::class, 'login']);

//Private API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
        Route::post('/employee', 'store')->name('employee.store');
        Route::get('/employee/{id}', 'show')->name('employee.show');
        Route::put('/employee/{id}', 'update')->name('employee.update'); //x-www-form-urlencoded
        Route::delete('/employee/{id}', 'destroy')->name('employee.destroy');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
        Route::post('/customers', 'store')->name('customer.store');
        Route::get('/customers/{id}', 'show')->name('customer.show');
        Route::put('/customers/{id}', 'update')->name('customer.update'); //x-www-form-urlencoded
        Route::delete('/customers/{id}', 'destroy')->name('customer.destroy');
    });
});         
