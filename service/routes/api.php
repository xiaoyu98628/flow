<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\FlowController;
use App\Http\Controllers\Api\V1\FlowNodeController;
use App\Http\Controllers\Api\V1\FlowNodeTaskController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
], function () {
    Route::group([
        'prefix' => 'v1',
        'as'     => 'v1.',
    ], function () {

        // 流程
        Route::apiResource('flows', FlowController::class)->only(['store']);
        Route::controller(FlowController::class)->prefix('flows')->as('flows.')->group(function () {
            Route::put('{id}/submit', 'submit')->name('submit');
            Route::put('{id}/cancel', 'cancel')->name('cancel');

            // 节点
            Route::controller(FlowNodeController::class)->prefix('nodes')->as('nodes.')->group(function () {

                // 任务
                Route::controller(FlowNodeTaskController::class)->prefix('tasks')->as('tasks.')->group(function () {
                    Route::put('{id}/approve', 'approve')->name('approve');
                });
            });
        });

    });
});
