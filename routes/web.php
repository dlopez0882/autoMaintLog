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

Route::post('/vehicles/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicle.store');
Route::get('/vehicle/{vehicle}', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicle');
Route::delete('/deletevehicle/{vehicle}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicle.destoy');

Route::post('/addworkitem', [App\Http\Controllers\WorkItemController::class, 'store'])->name('workitems.store');
Route::post('/updateworkitem/{workitem}', [App\Http\Controllers\WorkItemController::class, 'update'])->name('workitems.update');
Route::get('/workitems/{workitem}', [App\Http\Controllers\WorkItemController::class, 'show'])->name('workitems.show');
Route::delete('/deleteworkitem/{workitem}', [App\Http\Controllers\WorkItemController::class, 'destroy'])->name('workitems.destoy');