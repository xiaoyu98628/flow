<?php

declare(strict_types=1);

namespace App\Constants\Response\FailedCode;

use App\Constants\Response\Code;

enum SuccessCode: int implements Code
{
    /**************** 成功响应错误 ***************/

    case SUCCESS_OK            = 200000000; // 请求已成功，返回响应数据
    case SUCCESS_CREATED       = 201000000;  // 请求已成功，并且创建了新的资源
    case SUCCESS_ACCEPTED      = 202000000;  // 请求已接受，但尚未处理完成
    case SUCCESS_NO_CONTENT    = 204000000;  // 请求已成功，不返回任何内容
    case SUCCESS_RESET_CONTENT = 205000000;  // 请求已成功，不返回任何内容并要求请求者重置文档视图

    public function message(): string
    {
        return match ($this) {
            self::SUCCESS_OK            => '请求{title}成功',
            self::SUCCESS_CREATED       => '创建{title}成功',
            self::SUCCESS_ACCEPTED      => '请求已接受，正在处理中',
            self::SUCCESS_NO_CONTENT    => '操作{title}成功',
            self::SUCCESS_RESET_CONTENT => '操作{title}成功，请刷新',
        };
    }

    public function statusCode(): int
    {
        return match ($this) {
            self::SUCCESS_OK            => 200,
            self::SUCCESS_CREATED       => 201,
            self::SUCCESS_ACCEPTED      => 202,
            self::SUCCESS_NO_CONTENT    => 204,
            self::SUCCESS_RESET_CONTENT => 205,
        };
    }
}
