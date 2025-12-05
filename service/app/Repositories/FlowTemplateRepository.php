<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Constants\Enums\FlowTemplate\StatusEnum;
use App\Models\FlowTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * 流程模版仓库
 * @extends BaseRepository<FlowTemplate>
 */
class FlowTemplateRepository extends BaseRepository
{
    public function __construct(FlowTemplate $model)
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

        $query->when(! empty($inputs['type']), fn ($query) => $query->where('type', $inputs['type']));
        $query->when(! empty($inputs['status']), fn ($query) => $query->where('status', $inputs['status']));
        $query->when(! empty($inputs['name']), fn ($query) => $query->where('name', 'like', '%'.$inputs['name'].'%'));

        return $query->paginate($inputs['page_size']);
    }

    /**
     * @param  array  $inputs
     * @return Collection
     */
    public function list(array $inputs): Collection
    {
        $query = $this->query();

        $query->when(! empty($inputs['type']), fn ($query) => $query->where('type', $inputs['type']));
        $query->when(! empty($inputs['status']), fn ($query) => $query->where('status', $inputs['status']));

        return $query->get();
    }

    /**
     * @param  array  $inputs
     * @return FlowTemplate
     */
    public function store(array $inputs): FlowTemplate
    {
        if (empty($inputs)) {
            throw new InvalidArgumentException('参数错误');
        }

        return $this->query()->create([
            'type'   => Arr::get($inputs, 'type'),
            'code'   => Arr::get($inputs, 'code'),
            'name'   => Arr::get($inputs, 'name'),
            'remark' => Arr::get($inputs, 'remark'),
            'status' => StatusEnum::DISABLE->value,
        ]);
    }
}
