<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowVersionTemplate;

/**
 * 流程版本模版仓库
 * @extends BaseRepository<FlowVersionTemplate>
 */
class FlowVersionTemplateRepository extends BaseRepository
{
    public function __construct(FlowVersionTemplate $model)
    {
        $this->model = $model;
    }
}
