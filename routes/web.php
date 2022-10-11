<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userPhoneController;
use App\Http\Controllers\UserController;

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


//Route::resource('articles',userPhoneController::class)->middleware(['auth']);
Route::resource('albums',\App\Http\Controllers\AlbumController::class);
Route::get('albums/addImage/{album}',[\App\Http\Controllers\AlbumImageController::class, 'create'])->name('albums.addImage');
Route::post('albums/addImage/{album}',[\App\Http\Controllers\AlbumImageController::class, 'store'])->name('albums.storeImage');
Route::get('albums/moveImage/{album}',[\App\Http\Controllers\AlbumImageController::class, 'move'])->name('albums.moveImage');
Route::post('albums/pasteImages/{album}',[\App\Http\Controllers\AlbumImageController::class, 'paste'])->name('albums.pasteImages');

require __DIR__.'/auth.php';
