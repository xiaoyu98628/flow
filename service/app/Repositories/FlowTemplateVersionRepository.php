<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
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
     * @param  array  $inputs
     * @return LengthAwarePaginator
     */
    public function page(array $inputs): LengthAwarePaginator
    {
        $query = $this->query();

        $query->where('flow_template_id', Arr::get($inputs, 'flow_template_id'));

        return $query->paginate($inputs['page_size']);
    }

    /**
     * @param  array  $inputs
     * @return FlowTemplateVersion
     */
    public function store(array $inputs): FlowTemplateVersion
    {
        if (empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->create([
            'flow_template_id' => Arr::get($inputs, 'flow_template_id'),
            'name'             => Arr::get($inputs, 'name'),
            'callback'         => empty($inputs['callback']) ? null : $inputs['callback'],
            'status'           => StatusEnum::DRAFT->value,
            'extend'           => Arr::get($inputs, 'extend'),
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
            ->where('flow_template_id', Arr::get($inputs, 'flow_template_id'))
            ->firstOrFail();

        return $model->update([
            'name'     => Arr::get($inputs, 'name'),
            'callback' => empty($inputs['callback']) ? null : $inputs['callback'],
            'status'   => StatusEnum::DRAFT->value,
            'extend'   => Arr::get($inputs, 'extend'),
        ]);
    }

    /**
     * @param  string  $id
     * @param  array  $inputs
     * @return bool
     */
    public function status(string $id, array $inputs): bool
    {
        if (empty($id) || empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        $model = $this->query()->firstOrFail($id);

        return $model->update([
            'status' => Arr::get($inputs, 'status'),
        ]);
    }
}
