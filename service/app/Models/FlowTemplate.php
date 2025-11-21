<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $remark
 * @property int $current_version
 * @property string $status
 * @property string $created_at
 * @property string $created_operator_id
 * @property string $updated_at
 * @property string $updated_operator_id
 * @property string $deleted_at
 * @property string $deleted_operator_id
 */
class FlowTemplate extends BaseModel
{
    use SoftDeletes;

    protected $table = 'flow_templates';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];
}
