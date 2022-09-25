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

Route::get('/dashboard/{album_id}', [App\Http\Controllers\ImagesController::class, 'view_album_images']);
Route::post('/dashboard/{album_id}', [App\Http\Controllers\AlbumController::class, 'set_album_data']);
Route::post('/dashboard/{album_id}/store_images', [App\Http\Controllers\ImagesController::class, 'store_images']);
Route::post('/dashboard/{album_id}/update_image/{img_name}', [App\Http\Controllers\ImagesController::class, 'update_image']);
Route::put('/dashboard/{album_id}/update_image/{img_name}', [App\Http\Controllers\ImagesController::class, 'reset_img_token']);
Route::post('/dashboard/{album_id}/delete_image', [App\Http\Controllers\ImagesController::class, 'delete_image']);

Route::post('/new_album', [App\Http\Controllers\AlbumController::class, 'new_album']);
Route::post('/delete_album_and_images/{album_id}', [App\Http\Controllers\AlbumController::class, 'delete_album_and_images']);
Route::post('/delete_album_and_transfer_images/{album_id}', [App\Http\Controllers\AlbumController::class, 'delete_album_and_transfer_images']);

Route::get('/users/{user_uid}/albums/{album_id}/{file_name}', [App\Http\Controllers\ImagesController::class, 'get_private_image']);
Route::get('/public-albums/{album_id}/file/{file_name}', [App\Http\Controllers\PublicController::class, 'get_public_image']);