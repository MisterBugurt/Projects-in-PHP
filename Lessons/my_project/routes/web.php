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
Route::get('/workers', [\App\Http\Controllers\WorkerControler::class, 'index'])->name('worker.index');
Route::get('/workers/create', [\App\Http\Controllers\WorkerControler::class, 'create'])->name('worker.create');
Route::get('/workers/{worker}', [\App\Http\Controllers\WorkerControler::class, 'show'])->name('worker.show');
Route::post('/workers', [\App\Http\Controllers\WorkerControler::class, 'store'])->name('worker.store');
Route::get('/workers/{worker}/edit', [\App\Http\Controllers\WorkerControler::class, 'edit'])->name('worker.edit');
Route::patch('/workers/{worker}', [\App\Http\Controllers\WorkerControler::class, 'update'])->name('worker.update');
Route::delete('/workers/{worker}', [\App\Http\Controllers\WorkerControler::class, 'delete'])->name('worker.delete');



