<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\TshirtController;
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
    return view('choice');
});

Route::get('/backoffice', [BackOfficeController::class, 'index'])->name('backoffice.index');
Route::post('/backoffice', [BackOfficeController::class, 'upload']);

Route::get('/tshirt', [TshirtController::class, 'get']);
