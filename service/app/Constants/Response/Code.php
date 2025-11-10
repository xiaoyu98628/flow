<?php

declare(strict_types=1);

namespace App\Constants\Response;

/**
 * @property int $value
 */
interface Code
{
    public function message(): string;

    public function statusCode(): int;
}
