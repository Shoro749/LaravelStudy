<?php

use App\Http\Controllers\Api\Blog\PostController;
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
    $methods = ['index', 'store', 'update'];

    //BlogCategory
    Route::apiResource('categories', \App\Http\Controllers\Api\Blog\Admin\CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPost
    Route::apiResource('posts', \App\Http\Controllers\Api\Blog\Admin\PostController::class)
        ->except(['show']) //не робити маршрут для метода show
        ->names('blog.admin.posts');
});
