<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HutangController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('hutang', HutangController::class);
