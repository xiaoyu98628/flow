<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Constants\Enums\FlowVersionTemplate\StatusEnum;
use App\Models\FlowTemplate;
use App\Models\FlowTemplateVersion;
use Illuminate\Support\Arr;

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
     * @param  array  $inputs
     * @return FlowTemplate
     * @throws \Exception
     */
    public function store(array $inputs): FlowTemplate
    {
        if (empty($inputs)) {
            throw new \Exception('参数错误');
        }

        return $this->query()->create([
            'flow_template_id' => Arr::get($inputs, 'flow_template_id'),
            'name'             => Arr::get($inputs, 'name'),
            'callback'         => Arr::get($inputs, 'callback'),
            'status'           => StatusEnum::DRAFT->value,
            'extend'           => Arr::get($inputs, 'extend', null),
        ]);
    }
}
