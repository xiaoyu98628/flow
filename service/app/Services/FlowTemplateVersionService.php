<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Repositories\FlowTemplateVersionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

readonly class FlowTemplateVersionService
{
    public function __construct(
        private FlowTemplateVersionRepository $repository,
    ) {}

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ResponseHelper::success();
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return ResponseHelper::success();
    }

    /**
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            $flowVersionTemplate = $this->repository->store($inputs);

            DB::commit();

            return ResponseHelper::success();
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(string $id, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            DB::commit();

            return ResponseHelper::success();
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function status(string $id, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            DB::commit();

            return ResponseHelper::success();
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }
}
