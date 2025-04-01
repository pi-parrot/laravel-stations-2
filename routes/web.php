<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminMovieController;

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

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);

// Route::get('practice', function() {
//     return response('practice');
// });
Route::get('/practice', [PracticeController::class, 'sample']);

// Route::get('practice2', function() {
//     $test = 'practice2';
//     return response($test);
// });
Route::get('/practice2', [PracticeController::class, 'sample2']);

// Route::get('practice3', function() {
//     return response('test');
// });
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index']);

Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');

Route::get('/admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');

Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');

Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');

Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
