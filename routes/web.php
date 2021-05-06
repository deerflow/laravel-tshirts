<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CombinationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UIController;
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

Route::get('/', [CombinationController::class, 'index'])->name('index');
Route::post('/generate', [CombinationController::class, 'generate'])->name('combination.generate');

Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');

Route::prefix('tshirt')->group(function () {
    Route::post('/new', [TshirtController::class, 'new'])->name('tshirt.new');
    Route::delete('/remove/{id}', [TshirtController::class, 'remove'])->name('tshirt.remove');
});

Route::prefix('image')->group(function () {
    Route::post('/new', [ImageController::class, 'new'])->name('image.new');
    Route::delete('/remove/{id}', [ImageController::class, 'remove'])->name('image.remove');
});