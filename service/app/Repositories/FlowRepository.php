<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Flow;

/**
 * 流程模版仓库
 * @extends BaseRepository<Flow>
 */
class FlowRepository extends BaseRepository
{
    public function __construct(Flow $model)
    {
        $this->model = $model;
    }
}
