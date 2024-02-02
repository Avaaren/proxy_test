<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CheckerProxyController;
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

Route::get('/', [CheckerProxyController::class, 'index']);
Route::get('/history', [CheckerProxyController::class, 'history']);
Route::get('/history/{historyCheck}', [CheckerProxyController::class, 'historyDetail'])->name('historyDetail');
Route::post('/checkProxy', [CheckerProxyController::class, 'checkProxy'])->name('checkProxy');