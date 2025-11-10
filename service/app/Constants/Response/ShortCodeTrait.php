<?php

declare(strict_types=1);

namespace App\Constants\Response;

trait ShortCodeTrait
{
    public function getCode(): int
    {
        return intval(self::statusCode().self::projectCode().$this->value);
    }

    public function projectCode(): string
    {
        return config('system.project_code') ?: '0';
    }

    public function statusCode(): int
    {
        return 400;
    }
}
