<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\FlowController;
use App\Http\Controllers\Api\V1\FlowNodeTaskController;
use App\Http\Controllers\FlowTemplate\FlowTemplateController;
use App\Http\Controllers\FlowTemplate\FlowTemplateVersionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'as'     => 'v1.',
], function () {

    // 审批模版
    Route::group([
        'prefix' => 'flow-templates',
        'as'     => 'flow-templates.',
    ], function () {
        Route::put('{flow_template}/status', [FlowTemplateController::class, 'status'])->name('status');

        Route::group([
            'prefix' => 'versions',
            'as'     => 'versions.',
        ], function () {
            Route::put('{version}/status', [FlowTemplateVersionController::class, 'status'])->name('status');
        });
        Route::apiResource('versions', FlowTemplateVersionController::class)->except(['destroy']);
    });
    Route::apiResource('flow-templates', FlowTemplateController::class)->except(['destroy']);

    // 审批
    Route::group([
        'prefix' => 'flows',
        'as'     => 'flows.',
    ], function () {
        Route::put('{flow}/submit', [FlowController::class, 'submit'])->name('submit');
        Route::put('{flow}/cancel', [FlowController::class, 'cancel'])->name('cancel');

        Route::group([
            'prefix' => 'nodes',
            'as'     => 'nodes.',
        ], function () {

            Route::group([
                'prefix' => 'tasks',
                'as'     => 'tasks.',
            ], function () {
                Route::put('{task}/approve', [FlowNodeTaskController::class, 'approve'])->name('approve');
            });
        });
    });
    Route::apiResource('flows', FlowController::class)->only(['store']);
});
