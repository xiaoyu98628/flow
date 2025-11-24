<?php

declare(strict_types=1);

namespace App\Models;

use App\Constants\Enums\FlowNodeTemplate\TypeEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $parent_id
 * @property int $depth
 * @property int $priority
 * @property string $name
 * @property string $description
 * @property string $type
 * @property array $rules
 * @property array $callback
 * @property string $flow_version_template_id
 * @property string $created_at
 * @property string $created_operator_id
 * @property string $updated_at
 * @property string $updated_operator_id
 * @property string $deleted_at
 * @property string $deleted_operator_id
 */
class FlowNodeTemplate extends BaseModel
{
    use SoftDeletes;

    protected $table = 'flow_node_templates';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [
        'rules'    => 'array',
        'callback' => 'array',
    ];

    /**
     * 子节点
     * @return HasOne
     */
    public function children(): HasOne
    {
        return $this->hasOne(self::class, 'parent_id', 'id')
            ->whereNot('type', TypeEnum::CONDITION->value)
            ->with(['children', 'conditionNodes']);
    }

    /**
     * 条件节点
     * @return HasMany
     */
    public function conditionNodes(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->where('type', TypeEnum::CONDITION->value)
            ->with(['children', 'conditionNodes']);
    }
}
