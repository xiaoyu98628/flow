<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
use App\Models\FlowTemplate;
use App\Models\FlowTemplateVersion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * 流程版本模版仓库
 * @extends BaseRepository<FlowTemplateVersion>
 */
class FlowTemplateVersionRepository extends BaseRepository
{
    public function __construct(FlowTemplateVersion $model)
    {
        $this->model = $model;
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return LengthAwarePaginator
     */
    public function page(FlowTemplate $flowTemplate, array $inputs): LengthAwarePaginator
    {
        $query = $this->query();

        $query->where('flow_template_id', $flowTemplate->id);

        return $query->paginate($inputs['page_size']);
    }

    /**
     * @param  FlowTemplate  $flowTemplate
     * @param  array  $inputs
     * @return FlowTemplateVersion
     */
    public function store(FlowTemplate $flowTemplate, array $inputs): FlowTemplateVersion
    {
        if (empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->create([
            'flow_template_id' => $flowTemplate->id,
            'name'             => Arr::get($inputs, 'name'),
            'callback'         => empty($inputs['callback']) ? null : $inputs['callback'],
            'status'           => StatusEnum::DRAFT->value,
            'extend'           => Arr::get($inputs, 'extend'),
        ]);
    }
}
