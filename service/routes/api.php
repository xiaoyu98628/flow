<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\FlowController;
use App\Http\Controllers\Api\V1\FlowNodeTaskController;
use App\Http\Controllers\FlowTemplate\V1\FlowTemplateController;
use App\Http\Controllers\FlowTemplate\V1\FlowTemplateVersionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'as'     => 'v1.',
], function () {

    // 审批模版
    Route::group([
        'prefix' => 'flow-templates/{flow_template}',
        'as'     => 'flow-templates.',
    ], function () {
        Route::put('status', [FlowTemplateController::class, 'status'])->name('status');

        Route::group([
            'prefix' => 'flow_template_versions/{flow_template_version}',
            'as'     => 'versions.',
        ], function () {
            Route::put('status', [FlowTemplateVersionController::class, 'status'])->name('status');
        });
        Route::apiResource('flow_template_versions', FlowTemplateVersionController::class)->except(['destroy']);
    });
    Route::apiResource('flow-templates', FlowTemplateController::class)->except(['destroy']);


    // 审批
    Route::group([
        'prefix' => 'flows/{flow}',
        'as'     => 'flows.',
    ], function () {
        Route::put('submit', [FlowController::class, 'submit'])->name('submit');
        Route::put('cancel', [FlowController::class, 'cancel'])->name('cancel');

        Route::group([
            'prefix' => 'nodes/{node}',
            'as'     => 'nodes.',
        ], function () {

            Route::group([
                'prefix' => 'tasks/{task}',
                'as'     => 'tasks.',
            ], function () {
                Route::put('approve', [FlowNodeTaskController::class, 'approve'])->name('approve');
            });
        });
    });
    Route::apiResource('flows', FlowController::class)->only(['store']);
});
