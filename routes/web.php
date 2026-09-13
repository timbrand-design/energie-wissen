<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('/admin/articles/create', [ArticleController::class, 'create'])
    ->name('admin.articles.create');

Route::post('/admin/articles', [ArticleController::class, 'store'])
    ->name('admin.articles.store');