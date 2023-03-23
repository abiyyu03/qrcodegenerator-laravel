<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;


// Route::get('/{data?}',[GeneratorController::class,'index']);
Route::get('/generate',[GeneratorController::class,'generate']);
Route::post('/generate',[GeneratorController::class,'generate'])->name('generate');