<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @property string $id
 * @property string $title
 * @property string $type
 * @property string $code
 * @property string $parent_flow_id
 * @property string $parent_node_id
 * @property string $level
 * @property string $business_id
 * @property array $business_snapshot
 * @property string $status
 * @property array $callback
 * @property string $applicant_id
 * @property array $extend
 * @property string $flow_version_template_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Flow extends BaseModel
{
    protected $table = 'flows';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];
}
