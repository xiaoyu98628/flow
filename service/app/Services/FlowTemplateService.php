<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Response\FailedCode\ClientFailedCode;
use App\Helpers\ResponseHelper;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\FlowTemplateResource;
use App\Models\FlowTemplate;
use App\Repositories\FlowTemplateRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
     * @param  FlowTemplate  $flowTemplate
     * @return JsonResponse
     */
    public function show(FlowTemplate $flowTemplate): JsonResponse
    {
        return ResponseHelper::success(new FlowTemplateResource($flowTemplate));
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
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function update(FlowTemplate $flowTemplate, array $inputs): JsonResponse
    {
        try {
            return ResponseHelper::success($flowTemplate->update(Arr::only($inputs, ['name', 'remark'])));
        } catch (Throwable $e) {
            return ResponseHelper::fail(message: $e->getMessage());
        }
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return JsonResponse
     */
    public function status(FlowTemplate $flowTemplate, array $inputs): JsonResponse
    {
        try {

            if ($flowTemplate->status == $inputs['status']) {
                throw new AccessDeniedHttpException('流程模板已处于该状态');
            }

            return ResponseHelper::success($flowTemplate->update(Arr::only($inputs, ['status'])));
        } catch (AccessDeniedHttpException $e) {

            return ResponseHelper::fail(code: ClientFailedCode::CLIENT_FORBIDDEN_ERROR, message: $e->getMessage());
        } catch (Throwable $e) {
            return ResponseHelper::fail(message: $e->getMessage());
        }
    }
}
