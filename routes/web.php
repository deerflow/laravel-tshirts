<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CombinationController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UIController;
use App\Mail\ImageGenerated;
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

Route::get('/mail', function () {
    Mail::to('alu.florian@gmail.com')->send(new ImageGenerated());
    return 'Sent';
});

Route::get('/', [HistoricController::class, 'index'])->name('index');
Route::post('/adjust', [HistoricController::class, 'new'])->name('historic.new');
Route::patch('/adjust', [HistoricController::class, 'adjust'])->name('historic.adjust');
Route::post('/get-pdf', [HistoricController::class, 'generatePDF'])->name('historic.pdf');

Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');

Route::prefix('tshirt')->group(function () {
    Route::post('/new', [TshirtController::class, 'new'])->name('tshirt.new');
    Route::match(['GET', 'PUT'], '/edit/{id}', [TshirtController::class, 'edit'])->name('tshirt.edit');
    Route::delete('/remove/{id}', [TshirtController::class, 'remove'])->name('tshirt.remove');
});

Route::prefix('image')->group(function () {
    Route::post('/new', [ImageController::class, 'new'])->name('image.new');
    Route::match(['GET', 'PUT'], '/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
    Route::delete('/remove/{id}', [ImageController::class, 'remove'])->name('image.remove');
});

Route::get('/entry/all', [EntryController::class, 'all'])->name('entry.all');
