<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNodeSnapshot;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * 流程节点模版仓库
 * @extends BaseRepository<FlowNodeSnapshot>
 */
class FlowNodeSnapshotRepository extends BaseRepository
{
    public function __construct(FlowNodeSnapshot $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $inputs
     * @return FlowNodeSnapshot
     */
    public function store(array $inputs): FlowNodeSnapshot
    {
        if (empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->create([
            'snapshot'                 => Arr::get($inputs, 'snapshot'),
            'flow_version_template_id' => Arr::get($inputs, 'flow_version_template_id'),
        ]);
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return bool
     */
    public function update(string $id, array $inputs): bool
    {
        if (empty($id) || empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        $model = $this->query()
            ->where('id', $id)
            ->where('flow_version_template_id', $inputs['flow_version_template_id'])
            ->firstOrFail();

        return $model->update([
            'snapshot' => Arr::get($inputs, 'snapshot'),
        ]);
    }
}
