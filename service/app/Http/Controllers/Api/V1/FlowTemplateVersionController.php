<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Services\FlowTemplateVersionService;

class FlowTemplateVersionController extends Controller
{
    public function __construct(
        private readonly FlowTemplateVersionService $service,
    ) {}

    public function index()
    {
        return $this->service->index();
    }

    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function store()
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
