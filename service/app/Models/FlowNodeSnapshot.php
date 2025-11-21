<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @property string $id
 * @property string $flow_version_template_id
 * @property array $snapshot
 * @property string $created_at
 * @property string $created_operator_id
 * @property string $updated_at
 * @property string $updated_operator_id
 * @property string $deleted_at
 * @property string $deleted_operator_id
 */
class FlowNodeSnapshot extends BaseModel
{
    protected $table = 'flow_node_snapshots';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];
}
