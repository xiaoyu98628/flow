<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class FlowNodeTaskService
{
    /**
     * 更新
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function approve(string $id, array $inputs): JsonResponse
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
