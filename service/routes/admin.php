<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function () {
    Route::get('/', function () {
        dd(12313123111);
    });
});
