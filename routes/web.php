<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\LibrarybookController;

Route::get('/', [LibrarybookController::class, 'index']);
Route::post('/insert', [LibrarybookController::class, 'insert']);
Route::get('/delete/{id}', [LibrarybookController::class, 'delete']);
Route::post('/edit/{id}', [LibrarybookController::class, 'update']);