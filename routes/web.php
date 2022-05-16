<?php

use App\Http\Controllers\Request\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('requests.index');
});

Route::resource('requests', IndexController::class)
    ->only('update', 'index', 'destroy');