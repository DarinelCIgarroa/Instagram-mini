<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Nav Configuracion
Route::get('/config',   [UserController::class,'config'])->name('config');
Route::post('/update',  [UserController::class,'update'])->name('user.update');
Route::get('/profile/avatar/{filename}', [UserController::class,'getImage'])->name('user.avatar');

// Nav Subir imagen
Route::get('/upload/image', [ImageController::class,'create'])->name('upload.image');
Route::post('/save/image',  [ImageController::class, 'save'])->name('save.image');

// Ruta de extracción de imagenes publicadas
Route::get('/image/{filename}', [ImageController::class, 'getImage'])->name('image.public');

// Comentarios
Route::get('/image/comments/{image}', [CommentController::class, 'show'])->name('comment.show');
Route::post('/comment/save/{image}', [CommentController::class, 'save'])->name('save.comment');
Route::delete('/comment/{comment}',[CommentController::class,'delete'])->name('delete.comment');

// Likes
Route::get('/like/{image}',     [LikeController::class, 'likes'])->name('like.save');
Route::get('/dislike/{image}',  [LikeController::class, 'dislike'])->name('like.delete');
Route::get('/favorites',        [LikeController::class, 'favorites'])->name('likes');

//profile
Route::get('/profile/{user}',       [UserController::class,     'profile'])->name('user.profile');
Route::delete('/image/{id}/delete', [ImageController::class,    'delete'])->name('image.destroy');
Route::put('/image/{id}/edit',      [ImageController::class,    'update'])->name('image.update');
Route::get('/personas',             [UserController::class,     'peoples'])->name('peoples');