<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function () {
    Route::resource('tests', \App\Http\Controllers\V1\TestController::class)->only(['index']);
});
