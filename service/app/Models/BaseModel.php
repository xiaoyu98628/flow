<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasUlids;

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

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }
}
