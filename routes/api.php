<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PlansController;
use App\Http\Controllers\Api\ServicesController;

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
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');

//Private API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
        //Route::post('/employee', 'store')->name('employee.store');
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

    Route::controller(PlansController::class)->group(function(){
        Route::get('/plans', [PlansController::class, 'index'])->name('plans.index');
        Route::post('/plans', 'store')->name('plans.store');
        Route::get('/plans/{id}', 'show')->name('plans.show');
        Route::put('/plans/{id}', 'update')->name('plans.update');
        Route::put('/plans-image/{id}', 'update')->name('plans.updateImage');
        Route::delete('/plans/{id}', 'destroy')->name('plans.destroy');
    });

    Route::controller(PaymentController::class)->group(function(){
        Route::get('/payment', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('/payment', 'store')->name('payments.store');
        Route::get('/payment/{id}', 'show')->name('payments.show');
        Route::delete('/payment/{id}', 'destroy')->name('payments.destroy');
    });
});         
