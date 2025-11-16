<?php

declare(strict_types=1);

namespace App\Constants\Response\FailedCode;

use App\Constants\Response\Code;
use App\Constants\Response\ShortCode;
use App\Constants\Response\ShortCodeTrait;

enum SensitiveFailedCode: string implements Code, ShortCode
{
    use ShortCodeTrait;

    case AES_KEY_EMPTY      = '0201';
    case AES_DECRYPT_FAILED = '0202';

    public function message(): string
    {
        return match ($this) {
            self::AES_KEY_EMPTY      => 'system.aes.key或者cipher配置未配置',
            self::AES_DECRYPT_FAILED => '解密失败',
        };
    }

    public function statusCode(): int
    {
        return 400;
    }
}
