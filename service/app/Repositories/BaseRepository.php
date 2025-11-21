<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 数据仓库基本类
 * @template T of Model
 */
abstract class BaseRepository
{
    /** @var T 模型实例 */
    protected Model $model;

    /** @var Builder<T> 查询构造器 */
    protected Builder $query;

    /**
     * 初始化查询
     * @return Builder<T>
     */
    public function query(): Builder
    {
        $this->query = $this->model::query();

        return $this->query;
    }
}
