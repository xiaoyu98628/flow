<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
use App\Constants\Response\FailedCode\ClientFailedCode;
use App\Helpers\ResponseHelper;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\FlowTemplateVersionResource;
use App\Repositories\FlowTemplateVersionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

readonly class FlowTemplateVersionService
{
    public function __construct(
        private FlowTemplateVersionRepository $repository,
    ) {}

    /**
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function index(array $inputs): JsonResponse
    {
        return ResponseHelper::success(new BaseCollection($this->repository->page($inputs), FlowTemplateVersionResource::class));
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function show(string $id, array $inputs): JsonResponse
    {
        $model = $this->repository->query()->where('flow_template_id', Arr::get($inputs, 'flow_template_id'))->findOrFail($id);

        return ResponseHelper::success(new FlowTemplateVersionResource($model));
    }

    /**
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            $flowVersionTemplate = $this->repository->store($inputs);

            DB::commit();

            return ResponseHelper::success($flowVersionTemplate);
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(string $id, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            $model = $this->repository->query()->where('flow_template_id', Arr::get($inputs, 'flow_template_id'))->findOrFail($id);
            if ($model->status != StatusEnum::DRAFT->value) {
                throw new AccessDeniedHttpException('只有草稿流程模板版本可以更新');
            }

            $flowVersionTemplate = $this->repository->update($id, $inputs);

            DB::commit();

            return ResponseHelper::success();
        } catch (AccessDeniedHttpException $e) {
            DB::rollBack();

            return ResponseHelper::fail(code: ClientFailedCode::CLIENT_FORBIDDEN_ERROR, message: $e->getMessage());
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function status(string $id, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            $model = $this->repository->query()->where('flow_template_id', Arr::get($inputs, 'flow_template_id'))->findOrFail($id);
            if ($model->status != StatusEnum::DRAFT->value) {
                throw new AccessDeniedHttpException('只有草稿流程模板版本可以更新');
            }

            $this->repository->status($id, $inputs);

            DB::commit();

            return ResponseHelper::success();
        } catch (AccessDeniedHttpException $e) {
            DB::rollBack();

            return ResponseHelper::fail(code: ClientFailedCode::CLIENT_FORBIDDEN_ERROR, message: $e->getMessage());
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }
}
