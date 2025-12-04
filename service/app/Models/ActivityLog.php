<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
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
    use HasUlids;

    /** @var string 与表关联的主键 */
    protected $primaryKey = 'id';

    /** @var string 主键 ID 的数据类型 */
    protected $keyType = 'string';

    /** @var bool 表明模型的 ID 是否自增 */
    public $incrementing = false;

    /** @var bool 是否主动维护时间戳 */
    public $timestamps = true;

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [
        'properties' => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }
}
