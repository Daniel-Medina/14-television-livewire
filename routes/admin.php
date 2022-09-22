<?php

use App\Http\Controllers\Admin\ListaController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', PanelController::class)->name('dashboard');

//Controlador
Route::resource('videos', VideoController::class)->names('videos')->only('index', 'create', 'edit', 'update', 'store', 'destroy');
Route::resource('listas', ListaController::class)->names('listas')->only('index', 'create', 'edit', 'update', 'store', 'destroy');