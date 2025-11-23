<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\FlowTemplateResource;
use App\Repositories\FlowTemplateRepository;
use Illuminate\Http\JsonResponse;

readonly class FlowTemplateService
{
    public function __construct(
        private FlowTemplateRepository $repository,
    ) {}

    public function index(array $inputs): JsonResponse
    {
        return ResponseHelper::success(new BaseCollection($this->repository->page($inputs), FlowTemplateResource::class));
    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return ResponseHelper::success();
    }

    /**
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function store(array $inputs): JsonResponse
    {
        try {
            return ResponseHelper::success($this->repository->store($inputs));
        } catch (\Exception $e) {

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    public function update(string $id, array $inputs): JsonResponse
    {
        return ResponseHelper::success();
    }

    public function status(string $id, array $inputs): JsonResponse
    {
        return ResponseHelper::success();
    }
}
