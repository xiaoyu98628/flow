<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
use App\Constants\Response\FailedCode\ClientFailedCode;
use App\Helpers\ResponseHelper;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\FlowTemplateVersionResource;
use App\Models\FlowTemplate;
use App\Models\FlowTemplateVersion;
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
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function index(FlowTemplate $flowTemplate, array $inputs): JsonResponse
    {
        return ResponseHelper::success(new BaseCollection($this->repository->page($flowTemplate, $inputs), FlowTemplateVersionResource::class));
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  FlowTemplateVersion  $flowTemplateVersion
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function show(FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion, array $inputs): JsonResponse
    {
        return ResponseHelper::success(new FlowTemplateVersionResource($flowTemplateVersion));
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(FlowTemplate $flowTemplate, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            $flowVersionTemplate = $this->repository->store($flowTemplate, $inputs);

            DB::commit();

            return ResponseHelper::success($flowVersionTemplate);
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  FlowTemplateVersion  $flowTemplateVersion
     * @param  array  $inputs
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion, array $inputs): JsonResponse
    {
        DB::beginTransaction();
        try {
            if ($flowTemplateVersion->status != StatusEnum::DRAFT->value) {
                throw new AccessDeniedHttpException('只有草稿流程模板版本可以更新');
            }

            $inputs['callback']  = empty($inputs['callback']) ? null : $inputs['callback'];
            $flowVersionTemplate = $flowTemplateVersion->update(Arr::only($inputs, ['name', 'callback']));

            DB::commit();

            return ResponseHelper::success($flowVersionTemplate);
        } catch (AccessDeniedHttpException $e) {
            DB::rollBack();

            return ResponseHelper::fail(code: ClientFailedCode::CLIENT_FORBIDDEN_ERROR, message: $e->getMessage());
        } catch (Throwable $e) {
            DB::rollBack();

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  FlowTemplateVersion  $flowTemplateVersion
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function status(FlowTemplate $flowTemplate, FlowTemplateVersion $flowTemplateVersion, array $inputs): JsonResponse
    {
        try {
            if ($flowTemplateVersion->status != StatusEnum::DRAFT->value) {
                throw new AccessDeniedHttpException('只有草稿流程模板版本可以更新');
            }

            if ($flowTemplateVersion->status == $inputs['status']) {
                throw new AccessDeniedHttpException('流程模板版本已处于该状态');
            }

            $flowTemplateVersion->update(Arr::only($inputs, ['status']));

            return ResponseHelper::success();
        } catch (AccessDeniedHttpException $e) {

            return ResponseHelper::fail(code: ClientFailedCode::CLIENT_FORBIDDEN_ERROR, message: $e->getMessage());
        } catch (Throwable $e) {

            return ResponseHelper::fail(message: $e->getMessage());
        }
    }
}
