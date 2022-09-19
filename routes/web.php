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
// Route::get('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'show'])->name('vehicles.show');
Route::delete('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destoy');

Route::get('/vehicles/{vehicle}/serviceitems', [App\Http\Controllers\ServiceItemController::class, 'index'])->name('vehicles.serviceitems.index');
Route::post('/vehicles/{vehicle}/serviceitems', [App\Http\Controllers\ServiceItemController::class, 'store'])->name('vehicles.serviceitems.store');

Route::post('/serviceitems/{serviceitem}', [App\Http\Controllers\ServiceItemController::class, 'update'])->name('serviceitems.update');
Route::get('/serviceitems/{serviceitem}', [App\Http\Controllers\ServiceItemController::class, 'show'])->name('serviceitems.show');
Route::delete('/serviceitems/{serviceitem}', [App\Http\Controllers\ServiceItemController::class, 'destroy'])->name('serviceitems.destoy');