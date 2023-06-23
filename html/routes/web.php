<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SnippetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SnippetController::class, 'index'])->name('home');

Route::get('/snippet/new', [SnippetController::class, 'create'])->name('snippet.new');
Route::post('/snippet/save', [SnippetController::class, 'store'])->name('snippet.save');

Route::get('/snippet/{slug}', [SnippetController::class, 'show'])->name('snippet.show');
Route::get('/snippet/{slug}/like', [SnippetController::class, 'like'])->name('snippet.like');

// Comments
Route::post('/comment', [CommentController::class, 'store']);

// Borrar comentario
Route::delete('/comments/delete/{id}', [CommentController::class, 'destroy']);

// Eliminar SoftDelete


// Likes
// Follows


Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'authenticate']);

// Logout

// Register

// Profile
