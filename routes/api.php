<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;


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
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
// Route::post('/employee', 'store')->name('employee.store');
//Private API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee/{id}', 'show')->name('employee.show');
        Route::put('/employee/{$id}', 'update')->name('employee.update');
        Route::delete('/employee/{id}', 'destroy')->name('employee.destroy');
    });
});
