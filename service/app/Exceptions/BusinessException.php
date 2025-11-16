<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\Response\Code;
use App\Constants\Response\ShortCode;
use Exception;

class BusinessException extends Exception
{
    /**
     * Backing storage for accessors
     */
    private int $_statusCode;
    private Code $_responseCode;
    private string $_responseMessage;

    /**
     * Accessor properties (PHP 8.4)
     */
    public int $statusCode {
        get => $this->_statusCode;
    }

    public Code $responseCode {
        get => $this->_responseCode;
    }

    public string $responseMessage {
        get => $this->_responseMessage;
    }

    public function __construct(Code $responseCode, string $responseMessage = '')
    {
        // ① 设置枚举对象
        $this->_responseCode = $responseCode;

        // ② 状态码
        $this->_statusCode = $responseCode->statusCode();

        // ③ 真正的 message（手动传参 > 枚举默认文案）
        $message = $responseMessage !== ''
            ? $responseMessage
            : $responseCode->message();

        $this->_responseMessage = $message;

        // ④ 业务码：ShortCode / Code 分两种
        $code = $responseCode instanceof ShortCode
            ? $responseCode->getCode()
            : $responseCode->value;

        // 调用父类 Exception
        parent::__construct(message: $message, code: $code);
    }
}
