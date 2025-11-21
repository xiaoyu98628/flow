<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @property string $id
 * @property string $approver_id
 * @property string $approver_name
 * @property array $operation_info
 * @property string $status
 * @property string $flow_node_id
 * @property array $extend
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class FlowNodeTask extends BaseModel
{
    protected $table = 'flow_node_tasks';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];
}
