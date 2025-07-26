<?php

use App\Http\Controllers\Api\CallbackController;
use Illuminate\Support\Facades\Route;

Route::post('callback', CallbackController::class);
