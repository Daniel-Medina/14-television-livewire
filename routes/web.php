<?php

use App\Http\Controllers\Home\ListaController;
use App\Http\Controllers\Home\VideoController;
use App\Http\Livewire\Home\Videos\Search;
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

//Videos
Route::get('/', VideoController::class)->name('root');
Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('buscar/videos', Search::class)->name('search');

//Listas
Route::get('listas', [ListaController::class, 'index'])->name('listas.index');
Route::get('listas/{lista}', [ListaController::class, 'show'])->name('listas.show');
Route::get('listas/{lista}/{video}', [ListaController::class, 'details'])->name('listas.details');

//Politicas de privacidad
Route::get('privacidad', function() {
    return view('home.politicas');
});


/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
