<?php

declare(strict_types=1);

namespace App\Models;

use App\Constants\Enums\ActivityLog\EventEnum;
use App\Constants\Enums\TableEnum;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BaseModel extends Model
{
    use HasUlids, LogsActivity;

    /** @var string 数据库连接名 */
    protected $connection = 'mysql';

    /** @var string 与表关联的主键 */
    protected $primaryKey = 'id';

    /** @var string 主键 ID 的数据类型 */
    protected $keyType = 'string';

    /** @var bool 表明模型的 ID 是否自增 */
    public $incrementing = false;

    /** @var bool 是否主动维护时间戳 */
    public $timestamps = true;

    /**
     * 时间戳的存储格式 - 对于 datetime 字段不需要特别设置
     * 但如果您需要自定义格式，可以设置
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** @var array 不可被批量赋值的属性（黑名单） */
    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName($this->table)
            ->logOnly($this->getTableColumns())
            ->logOnlyDirty() // 只记录实际被修改的字段
            ->dontSubmitEmptyLogs() // 没有字段变化时不记录日志
            ->setDescriptionForEvent(
                fn (string $eventName) => TableEnum::tryFrom($this->table)->label().' :subject.id '.EventEnum::tryFrom($eventName)->label()
            );
    }

    /**
     * 获取当前模型对应数据库表的所有字段名
     * @return string[]
     */
    public function getTableColumns(): array
    {
        // 获取当前模型实例
        $instance = new static;

        // 通过数据库连接获取架构构建器，并查询字段列表
        return $instance->getConnection()->getSchemaBuilder()->getColumnListing($instance->getTable());
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }
}
