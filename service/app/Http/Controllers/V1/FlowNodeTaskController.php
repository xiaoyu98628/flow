<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowNodeTask\FlowNodeTaskRequest;
use App\Services\FlowNodeTaskService;
use Illuminate\Http\JsonResponse;
use Throwable;

class FlowNodeTaskController extends Controller
{
    public function __construct(
        private FlowNodeTaskService $service,
    ) {}

    /**
     * 审批
     * @param  FlowNodeTaskRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function approve(FlowNodeTaskRequest $request, string $id)
    {
        return $this->service->approve($id, RequestHelper::getInputs());
    }
}
