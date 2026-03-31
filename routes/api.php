<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Public Book Routes
Route::apiResource('books', BookController::class);