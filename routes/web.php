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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [App\Http\Controllers\AlbumController::class, 'view_albums'])->middleware(['auth'])->name('dashboard');

Route::post('/dashboard/{album_id}', [App\Http\Controllers\AlbumController::class, 'set_album_data']);
Route::post('/new_album', [App\Http\Controllers\AlbumController::class, 'new_album']);

Route::get('/dashboard/{album_id}', [App\Http\Controllers\ImagesController::class, 'view_album_images']);
Route::post('/dashboard/{album_id}/store_images', [App\Http\Controllers\ImagesController::class, 'store_images']);
Route::post('/dashboard/{album_id}/delete_image', [App\Http\Controllers\ImagesController::class, 'delete_image']);