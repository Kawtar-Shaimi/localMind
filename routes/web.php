<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [QuestionController::class, 'index']);
Route::resource('questions', QuestionController::class);
Route::resource('answers', AnswerController::class);
