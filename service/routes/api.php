<?php

use Illuminate\Support\Facades\Route;

Route::resource('tests', \App\Http\Controllers\V1\TestController::class)->only(['index']);
