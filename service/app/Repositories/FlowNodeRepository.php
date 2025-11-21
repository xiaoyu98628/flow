<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNode;

/**
 * 流程模版仓库
 * @extends BaseRepository<FlowNode>
 */
class FlowNodeRepository extends BaseRepository
{
    public function __construct(FlowNode $model)
    {
        $this->model = $model;
    }
}
