<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminReservationController;

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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [SheetController::class, 'reserve'])->name('sheets.reserve');
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

Route::get('/sheets', [SheetController::class, 'index'])->name('sheets.index');

Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
Route::get('/admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('/admin/movies/{id}', [AdminMovieController::class, 'show'])->name('admin.movies.show');
Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::delete('/admin/movies/{id}/destroy', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');

Route::get('/admin/schedules/{id}', [AdminScheduleController::class, 'index'])->name('admin.schedules.index');
Route::get('/admin/schedules/{id}/show', [AdminScheduleController::class, 'show'])->name('admin.schedules.show');
Route::get('/admin/movies/{id}/schedules/create', [AdminScheduleController::class, 'create'])->name('admin.schedules.create');
Route::post('/admin/movies/{id}/schedules/store', [AdminScheduleController::class, 'store'])->name('admin.schedules.store');
Route::get('/admin/schedules/{scheduleId}/edit', [AdminScheduleController::class, 'edit'])->name('admin.schedules.edit');
Route::patch('/admin/schedules/{id}/update', [AdminScheduleController::class, 'update'])->name('admin.schedules.update');
Route::delete('/admin/schedules/{id}/destroy', [AdminScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
Route::get('/admin/reservations/create', [AdminReservationController::class, 'create'])->name('admin.reservations.create');
// 一覧と同じURLだがメソッド違いで処理を分ける
Route::post('/admin/reservations', [AdminReservationController::class, 'store'])->name('admin.reservations.store');
// Route::get('/admin/reservations/{id}', [AdminReservationController::class, 'show'])->name('admin.reservations.show');
Route::get('/admin/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
Route::patch('/admin/reservations/{id}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
Route::delete('/admin/reservations/{id}', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');
