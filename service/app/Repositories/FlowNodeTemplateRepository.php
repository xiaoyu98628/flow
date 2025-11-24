<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNodeTemplate;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * 流程节点模版仓库
 * @extends BaseRepository<FlowNodeTemplate>
 */
class FlowNodeTemplateRepository extends BaseRepository
{
    public function __construct(FlowNodeTemplate $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $inputs
     * @return FlowNodeTemplate
     */
    public function store(array $inputs): FlowNodeTemplate
    {
        if (empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->create([
            'parent_id'                => Arr::get($inputs, 'parent_id'),
            'depth'                    => Arr::get($inputs, 'depth'),
            'priority'                 => Arr::get($inputs, 'priority'),
            'name'                     => Arr::get($inputs, 'name'),
            'description'              => Arr::get($inputs, 'description'),
            'type'                     => Arr::get($inputs, 'type'),
            'rules'                    => empty($inputs['rules']) ? null : $inputs['rules'],
            'callback'                 => empty($inputs['callback']) ? null : $inputs['callback'],
            'flow_version_template_id' => Arr::get($inputs, 'flow_version_template_id'),
        ]);
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return int
     */
    public function update(string $id, array $inputs): int
    {
        if (empty($id) || empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->where('id', $id)->update([
            'parent_id'                => Arr::get($inputs, 'parent_id'),
            'depth'                    => Arr::get($inputs, 'depth'),
            'priority'                 => Arr::get($inputs, 'priority'),
            'name'                     => Arr::get($inputs, 'name'),
            'description'              => Arr::get($inputs, 'description'),
            'type'                     => Arr::get($inputs, 'type'),
            'rules'                    => empty($inputs['rules']) ? null : $inputs['rules'],
            'callback'                 => empty($inputs['callback']) ? null : $inputs['callback'],
            'flow_version_template_id' => Arr::get($inputs, 'flow_version_template_id'),
        ]);
    }
}
