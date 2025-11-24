<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\FlowTemplateResource;
use App\Repositories\FlowTemplateRepository;
use Illuminate\Http\JsonResponse;
use Throwable;

readonly class FlowTemplateService
{
    public function __construct(
        private FlowTemplateRepository $repository,
    ) {}

    /**
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function index(array $inputs): JsonResponse
    {
        return ResponseHelper::success(new BaseCollection($this->repository->page($inputs), FlowTemplateResource::class));
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return ResponseHelper::success(new FlowTemplateResource($this->repository->query()->findOrFail($id)));
    }

    /**
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function store(array $inputs): JsonResponse
    {
        try {
            return ResponseHelper::success($this->repository->store($inputs));
        } catch (Throwable $e) {
            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function update(string $id, array $inputs): JsonResponse
    {
        try {
            $this->repository->query()->findOrFail($id);

            return ResponseHelper::success($this->repository->update($id, $inputs));
        } catch (Throwable $e) {
            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function status(string $id, array $inputs): JsonResponse
    {
        try {
            $this->repository->query()->findOrFail($id);

            return ResponseHelper::success($this->repository->status($id, $inputs));
        } catch (Throwable $e) {
            return ResponseHelper::fail(message: $e->getMessage());
        }
    }
}
