<?php

declare(strict_types=1);

namespace App\Http\Controllers\FlowTemplate\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowTemplateVersion\FlowTemplateVersionRequest;
use App\Models\FlowTemplate;
use App\Models\FlowTemplateVersion;
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
    public function index(FlowTemplateVersionRequest $request, FlowTemplate $flowTemplate)
    {
        return $this->service->index($flowTemplate, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(FlowTemplateVersionRequest $request, FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion)
    {
        return $this->service->show($flowTemplate, $flowTemplateVersion, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(FlowTemplateVersionRequest $request, FlowTemplate $flowTemplate)
    {
        return $this->service->store($flowTemplate, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(FlowTemplateVersionRequest $request, FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion)
    {
        return $this->service->update($flowTemplate, $flowTemplateVersion, RequestHelper::getInputs());
    }

    /**
     * @param  FlowTemplateVersionRequest  $request
     * @param  string  $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function status(FlowTemplateVersionRequest $request, FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion)
    {
        return $this->service->status($flowTemplate, $flowTemplateVersion, RequestHelper::getInputs());
    }
}
