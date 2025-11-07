<?php

declare(strict_types=1);

use App\Helpers\EncryptionHelper;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group([
    'prefix' => 'v1',
    'as'     => 'v1.',
], function () {
    // 参数加密
    Route::post('encrypt', function (Request $request) {
        return EncryptionHelper::encrypt($request->all());
    })->name('encrypt');

    // 参数解密
    Route::get('decrypt', function (Request $request) {
        return $request->all();
    })->name('decrypt');
});
