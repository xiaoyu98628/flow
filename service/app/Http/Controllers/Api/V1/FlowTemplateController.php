<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowTemplate\FlowTemplateRequest;
use App\Services\FlowTemplateService;
use Illuminate\Http\JsonResponse;

class FlowTemplateController extends Controller
{
    public function __construct(
        private readonly FlowTemplateService $service,
    ) {}

    public function index()
    {
        return $this->service->index(RequestHelper::getInputs([]));
    }

    /**
     * @param  FlowTemplateRequest  $request
     * @return JsonResponse
     */
    public function store(FlowTemplateRequest $request)
    {
        return $this->service->store(RequestHelper::getInputs([]));
    }

    public function update(string $id)
    {
        return $this->service->update($id, RequestHelper::getInputs([]));
    }

    public function status(string $id)
    {
        return $this->service->status($id, RequestHelper::getInputs([]));
    }
}
