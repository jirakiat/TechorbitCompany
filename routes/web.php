<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\frontendcontroller::class, "index"]);


Route::post('/contact', [\App\Http\Controllers\frontendcontroller::class, 'contact']);
