<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TCCController;

Route::get('/', [TCCController::class, 'index'])->name('tcc.index');

// TCC site routes
Route::get('/tcc', [TCCController::class, 'index']);
Route::get('/tcc/todos', [TCCController::class, 'todos'])->name('tcc.todos');
