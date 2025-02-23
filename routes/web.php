<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/* Auth routes */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerView'])->name('registerView');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('/')->middleware('auth')->group(function () {
    /* Home route */
    route::get('/', [QuestionController::class, 'index'])->name('home');

    /* Questions routes */
    Route::prefix('questions')->as('questions.')->group(function () {
        route::get('/create', [QuestionController::class, 'create'])->name('create');
        route::post('/store', [QuestionController::class, 'store'])->name('store');
        route::get('/{question}', [QuestionController::class, 'show'])->name('show');
        route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('edit');
        route::put('/{question}', [QuestionController::class, 'update'])->name('update');
        route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy');
    });

    /* Answers routes */
    Route::prefix('answers')->as('answers.')->group(function () {
        route::post('/store', [AnswerController::class, 'store'])->name('store');
        route::put('/{answer}', [AnswerController::class, 'update'])->name('update');
        route::delete('/{answer}', [AnswerController::class, 'destroy'])->name('destroy');
    });

    /* Favorites routes */
    Route::prefix('favorites')->as('favorites.')->group(function () {
        route::get('/', [FavoriteController::class, 'index'])->name('index');
        route::post('/store', [FavoriteController::class, 'store'])->name('store');
        route::delete('/{favorite}', [FavoriteController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/create', function () {
    return view('questions.create');
});
Route::get('/edit', function () {
    return view('questions.edit');
});
Route::get('/show', function () {
    return view('questions.show');
});