<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

// Routes pour les utilisateurs connectés
Route::middleware('auth')->group(function () {
    // Questions
    Route::get('/questions/create', [QuestionController::class, 'create']);
    Route::post('/questions', [QuestionController::class, 'store']);
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit']);
    Route::put('/questions/{id}', [QuestionController::class, 'update']);
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
    
    // Réponses
    Route::post('/questions/{question_id}/answers', [AnswerController::class, 'store']);
    Route::delete('/answers/{id}', [AnswerController::class, 'destroy']);
    
    // Favoris
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/questions/{question_id}/favorite', [FavoriteController::class, 'store']);
    Route::delete('/questions/{question_id}/favorite', [FavoriteController::class, 'destroy']);
});

// Routes publiques
Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);
