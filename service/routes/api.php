<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
], function () {
    Route::group([
        'prefix' => 'v1',
        'as'     => 'v1.',
    ], function () {
        Route::resource('tests', \App\Http\Controllers\V1\TestController::class)->only(['index', 'store']);
    });
});
