<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowTemplateVersion\FlowTemplateVersionRequest;
use App\Services\FlowTemplateVersionService;
use Illuminate\Http\JsonResponse;
use Throwable;

class FlowTemplateVersionController extends Controller
{
    public function __construct(
        private readonly FlowTemplateVersionService $service,
    ) {}

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @return JsonResponse
     */
    public function index(FlowTemplateVersionRequest $request)
    {
        return $this->service->index(RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(FlowTemplateVersionRequest $request, string $id)
    {
        return $this->service->show($id, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(FlowTemplateVersionRequest $request)
    {
        return $this->service->store(RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(FlowTemplateVersionRequest $request, string $id)
    {
        return $this->service->update($id, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function status(FlowTemplateVersionRequest $request, string $id)
    {
        return $this->service->status($id, RequestHelper::getInputs());
    }
}
