<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $flow_template_id
 * @property int $version
 * @property string $status
 * @property string $name
 * @property array $callback
 * @property array $extend
 * @property string $created_at
 * @property string $created_operator_id
 * @property string $updated_at
 * @property string $updated_operator_id
 * @property string $deleted_at
 * @property string $deleted_operator_id
 */
class FlowTemplateVersion extends BaseModel
{
    use SoftDeletes;

    protected $table = 'flow_template_versions';

    /** @var array 获取应该强制转换的属性 */
    protected $casts = [
        'callback' => 'array',
        'extend'   => 'array',
    ];

    /**
     * @return HasOne
     */
    public function nodeTemplateTree(): HasOne
    {
        return $this->hasOne(FlowNodeTemplate::class, 'flow_template_id', 'id')->whereNull('parent_id');
    }

    public function nodeSnapshot()
    {
        return $this->hasOne(FlowNodeSnapshot::class, 'flow_template_id', 'id');
    }
}
