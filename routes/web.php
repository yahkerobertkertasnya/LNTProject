<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\KaryawanController::class, 'getEmployee']);

Route::post('/', [\App\Http\Controllers\KaryawanController::class, 'getFilteredEmployee']);

Route::post('/delete', [\App\Http\Controllers\KaryawanController::class, 'deleteEmployee']);
Route::post('/addEmployee', [\App\Http\Controllers\KaryawanController::class, 'addEmployee']);
Route::post('/updateEmployee', [\App\Http\Controllers\KaryawanController::class, 'updateEmployee']);
