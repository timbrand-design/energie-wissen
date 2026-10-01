<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/articles', [ArticleController::class, 'index'])
->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])
->name('articles.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])
        ->name('admin.articles.index');

    Route::get('/admin/articles/create', [ArticleController::class, 'create'])
        ->name('admin.articles.create');

    Route::post('/admin/articles', [ArticleController::class, 'store'])
        ->name('admin.articles.store');

    Route::get('/admin/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('admin.articles.edit');

    Route::put('/admin/articles/{article}', [ArticleController::class, 'update'])
        ->name('admin.articles.update');

    Route::delete('/admin/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('admin.articles.destroy');
});

require __DIR__.'/auth.php';
