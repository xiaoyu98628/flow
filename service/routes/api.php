<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\FlowController;
use App\Http\Controllers\Api\V1\FlowNodeController;
use App\Http\Controllers\Api\V1\FlowNodeTaskController;
use App\Http\Controllers\Api\V1\FlowTemplateController;
use App\Http\Controllers\Api\V1\FlowTemplateVersionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'as'     => 'v1.',
], function () {

    // 审批模版
    Route::controller(FlowTemplateController::class)->prefix('flow-templates')->as('flow-templates.')->group(function () {
        Route::put('{id}/status', 'status')->name('status');

        // 审批模版版本
        Route::controller(FlowTemplateVersionController::class)->prefix('versions')->as('versions.')->group(function () {
            Route::put('{id}/status', 'status')->name('status');

        });
        Route::apiResource('versions', FlowTemplateVersionController::class)->except(['destroy']);
    });
    Route::apiResource('flow-templates', FlowTemplateController::class)->except(['destroy']);


    // 审批
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
    Route::apiResource('flows', FlowController::class)->only(['store']);

});
