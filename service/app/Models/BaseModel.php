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

    /** @var bool 是否使用时间戳 */
    public $timestamps = false;

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [];

    /** @var array 不可被批量赋值的属性（黑名单） */
    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
