<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Main');
});

Route::get('/action', function() {
    return ('Olá mundo!');
});

Route::get('/main/{value}', [MainController::class, 'index']);

