<?php

declare(strict_types=1);

namespace App\Http\Controllers\FlowTemplate\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowTemplate\FlowTemplateRequest;
use App\Models\FlowTemplate;
use App\Services\FlowTemplateService;
use Illuminate\Http\JsonResponse;

class FlowTemplateController extends Controller
{
    public function __construct(
        private readonly FlowTemplateService $service,
    ) {}

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->service->index(RequestHelper::getInputs());
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(FlowTemplate $flowTemplate)
    {
        return $this->service->show($flowTemplate);
    }

    /**
     * @param  FlowTemplateRequest  $request
     * @return JsonResponse
     */
    public function store(FlowTemplateRequest $request)
    {
        return $this->service->store(RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateRequest  $request
     * @param  FlowTemplate  $flowTemplate
     * @return JsonResponse
     */
    public function update(FlowTemplateRequest $request, FlowTemplate $flowTemplate)
    {
        return $this->service->update($flowTemplate, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateRequest  $request
     * @param  FlowTemplate  $flowTemplate
     * @return JsonResponse
     */
    public function status(FlowTemplateRequest $request, FlowTemplate $flowTemplate)
    {
        return $this->service->status($flowTemplate, RequestHelper::getInputs());
    }
}
