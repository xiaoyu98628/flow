<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $log_name
 * @property string $description
 * @property string $subject_type
 * @property string $event
 * @property string $subject_id
 * @property string $causer_type
 * @property string $causer_id
 * @property array $properties
 * @property string $batch_uuid
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityLog extends Activity
{
    protected $table = 'flow_nodes';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [
        'properties' => 'array',
    ];
}
