<?php

declare(strict_types=1);

namespace App\Constants\Enums\FlowTemplateVersion;

use App\Constants\Enums\BaseEnumTrait;
use App\Constants\Enums\EnumInterface;

enum StatusEnum: string implements EnumInterface
{
    use BaseEnumTrait;

    case DRAFT     = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED  = 'archived';

    /**
     * 获取用户友好的标签
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::DRAFT     => '草稿',
            self::PUBLISHED => '已发布',
            self::ARCHIVED  => '已归档',
        };
    }
}
