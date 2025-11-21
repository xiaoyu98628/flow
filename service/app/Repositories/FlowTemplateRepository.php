<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowTemplate;

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
}
