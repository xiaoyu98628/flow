<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

readonly class FlowService
{
    /**
     * 创建审批流程
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(array $inputs): JsonResponse
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
     * 提交审批流程
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function submit(string $id, array $inputs): JsonResponse
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
     * 取消审批流程
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws \Throwable
     */
    public function cancel(string $id, array $inputs): JsonResponse
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
