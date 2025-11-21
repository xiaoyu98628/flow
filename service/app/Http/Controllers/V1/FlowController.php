<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Constants\Enums\Flow\StatusEnum;
use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flow\FlowRequest;
use App\Services\FlowService;
use Illuminate\Http\JsonResponse;
use Throwable;

class FlowController extends Controller
{
    public function __construct(
        private readonly FlowService $service,
    ) {}

    /**
     * 创建流程
     * @param  FlowRequest  $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(FlowRequest $request)
    {
        return $this->service->store(RequestHelper::getInputs([
            'code'        => '',
            'business_id' => '',
            'is_draft'    => '',
        ]));
    }

    /**
     * 提交流程
     * @param  FlowRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function submit(FlowRequest $request, string $id)
    {
        return $this->service->submit($id, RequestHelper::getInputs([
            'status' => StatusEnum::APPROVED->value,
        ]));
    }

    /**
     * 取消流程
     * @param  FlowRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function cancel(FlowRequest $request, string $id)
    {
        return $this->service->cancel($id, RequestHelper::getInputs([
            'status' => StatusEnum::APPROVED->value,
        ]));
    }
}
