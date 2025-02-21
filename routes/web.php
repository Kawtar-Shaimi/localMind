<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;

route::get('/', function(){
    return view('login');
});

route::get('/dashboard', function(){
    return view('dashboard');
});