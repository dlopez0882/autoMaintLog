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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/vehicles', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'show'])->name('vehicles.show');
Route::delete('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destoy');

Route::post('/workitems', [App\Http\Controllers\WorkItemController::class, 'store'])->name('workitems.store');
Route::post('/updateworkitem/{workitem}', [App\Http\Controllers\WorkItemController::class, 'update'])->name('workitems.update');
Route::get('/workitems/{workitem}', [App\Http\Controllers\WorkItemController::class, 'show'])->name('workitems.show');
Route::delete('/deleteworkitem/{workitem}', [App\Http\Controllers\WorkItemController::class, 'destroy'])->name('workitems.destoy');