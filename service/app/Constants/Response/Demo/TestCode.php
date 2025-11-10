<?php

declare(strict_types=1);

namespace App\Constants\Response\Demo;

use App\Constants\Response\Code;
use App\Constants\Response\ShortCode;
use App\Constants\Response\ShortCodeTrait;

enum TestCode: string implements Code, ShortCode
{
    use ShortCodeTrait;

    case ERROR = '0101';

    public function message(): string
    {
        return match ($this) {
            self::ERROR => '示例代码',
        };
    }
}
