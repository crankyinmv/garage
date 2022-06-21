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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Cars
Route::get('/cars', [App\Http\Controllers\CarsController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [App\Http\Controllers\CarsController::class, 'show'])->name('cars.show');
Route::get('/cars/create', [App\Http\Controllers\CarsController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}', [App\Http\Controllers\CarsController::class, 'update'])->name('cars.update');
Route::post('/cars', [App\Http\Controllers\CarsController::class, 'create'])->name('cars.create');
Route::post('/cars/delete/{car}', [App\Http\Controllers\CarsController::class, 'delete'])->name('cars.delete');

// Trucks
Route::get('/trucks', [App\Http\Controllers\TrucksController::class, 'index'])->name('trucks.index');
Route::get('/trucks/{truck}', [App\Http\Controllers\TrucksController::class, 'show'])->name('trucks.show');
Route::get('/trucks/create', [App\Http\Controllers\TrucksController::class, 'show'])->name('trucks.show');
Route::post('/trucks/{truck}', [App\Http\Controllers\TrucksController::class, 'update'])->name('trucks.update');
Route::post('/trucks', [App\Http\Controllers\TrucksController::class, 'create'])->name('trucks.create');
Route::post('/trucks/delete/{truck}', [App\Http\Controllers\TrucksController::class, 'delete'])->name('trucks.delete');

// Boats
Route::get('/boats', [App\Http\Controllers\BoatsController::class, 'index'])->name('boats.index');
Route::get('/boats/{boat}', [App\Http\Controllers\BoatsController::class, 'show'])->name('boats.show');
Route::get('/boats/create', [App\Http\Controllers\BoatsController::class, 'show'])->name('boats.show');
Route::post('/boats/{boat}', [App\Http\Controllers\BoatsController::class, 'update'])->name('boats.update');
Route::post('/boats', [App\Http\Controllers\BoatsController::class, 'create'])->name('boats.create');
Route::post('/boats/delete/{boat}', [App\Http\Controllers\BoatsController::class, 'delete'])->name('boats.delete');
