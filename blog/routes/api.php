<?php

use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\DiggingDeeperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', \App\Http\Controllers\Api\Blog\PostController::class)->names('blog.posts');
});

//Адмінка
Route::group(['prefix' => 'admin/blog'], function () {
    // Масив $methods більше не потрібен для категорій, якщо вони повноцінні

    // BlogCategory
    Route::apiResource('categories', \App\Http\Controllers\Api\Blog\Admin\CategoryController::class)
        ->names('blog.admin.categories');

    // BlogPost
    Route::apiResource('posts', \App\Http\Controllers\Api\Blog\Admin\PostController::class)
        ->except(['show']) // не робити маршрут для метода show
        ->names('blog.admin.posts');
});

Route::prefix('digging_deeper')->group(function () {
    Route::get('process-video', [DiggingDeeperController::class, 'processVideo'])->name('digging_deeper.processVideo');
    Route::get('prepare-catalog', [DiggingDeeperController::class, 'prepareCatalog'])->name('digging_deeper.prepareCatalog');
});
