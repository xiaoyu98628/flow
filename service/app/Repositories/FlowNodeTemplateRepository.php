<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowNodeTemplate;

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
}
