<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;

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

Route::get('/', [BlogController::class,'index'])
    ->name('blog.index');

Route::prefix('/post')
    ->group(function () {
        Route::get('/', [PostController::class,'index'])
            ->name('post.index');
        Route::get('/add', [PostController::class,'add'])
            ->name('post.add');
        Route::post('/save', [PostController::class,'save'])
            ->name('post.save');
        Route::get('/delete', [PostController::class,'delete'])
            ->name('post.delete');
});

Route::prefix('/account')
    ->group(function () {
        Route::get('/', [AccountController::class,'index'])
            ->name('account.index');
        Route::get('/add', [AccountController::class,'add'])
            ->name('account.add');
        Route::post('/save', [AccountController::class,'save'])
            ->name('account.save');
        Route::get('/delete', [AccountController::class,'delete'])
            ->name('account.delete');
});

Route::get('/login', [LoginController::class,'index'])
    ->name('login');
Route::post('/login-validate', [LoginController::class,'loginValidate'])
    ->name('login.validate');

Route::get('/logout', [LoginController::class,'logout'])
    ->name('logout');