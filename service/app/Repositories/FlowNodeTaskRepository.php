<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNodeTask;

/**
 * 流程模版仓库
 * @extends BaseRepository<FlowNodeTask>
 */
class FlowNodeTaskRepository extends BaseRepository
{
    public function __construct(FlowNodeTask $model)
    {
        $this->model = $model;
    }
}
