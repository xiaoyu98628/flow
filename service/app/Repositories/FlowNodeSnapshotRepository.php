<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNodeSnapshot;

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
}
