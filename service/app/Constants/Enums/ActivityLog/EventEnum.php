<?php

declare(strict_types=1);

namespace App\Constants\Enums\ActivityLog;

use App\Constants\Enums\BaseEnumTrait;
use App\Constants\Enums\EnumInterface;

enum EventEnum: string implements EnumInterface
{
    use BaseEnumTrait;

    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';

    public function label(): string
    {
        return match ($this) {
            self::CREATED => '创建',
            self::UPDATED => '更新',
            self::DELETED => '删除',
        };
    }
}
