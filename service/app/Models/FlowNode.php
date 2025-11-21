<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @property string $id
 * @property string $parent_id
 * @property int $depth
 * @property int $priority
 * @property string $name
 * @property string $type
 * @property array $rules
 * @property string $status
 * @property array $callback
 * @property string $flow_id
 * @property array $extend
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class FlowNode extends BaseModel
{
    protected $table = 'flow_nodes';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];
}
