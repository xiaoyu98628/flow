<?php

declare(strict_types=1);

namespace App\Constants\Response\FailedCode;

use App\Constants\Response\Code;

enum ClientFailedCode: int implements Code
{
    /**************** 客户端错误 ***************/

    // 400 - 错误的请求
    case CLIENT_BAD_REQUEST_ERROR = 4000000101;
    case CLIENT_CREATED_ERROR     = 4000000102;
    case CLIENT_DELETED_ERROR     = 4000000103;
    case RESOURCE_TYPE_ERROR      = 4000000104;

    // 401 - 访问被拒绝
    case CLIENT_HTTP_UNAUTHORIZED_ERROR             = 4010000101;
    case CLIENT_HTTP_UNAUTHORIZED_EXPIRED_ERROR     = 4010000102;
    case CLIENT_HTTP_UNAUTHORIZED_BLACKLISTED_ERROR = 4010000103;

    // 403 - 禁止访问
    case CLIENT_FORBIDDEN_ERROR = 4030000101;

    // 404 - 没有找到文件或目录
    case NOT_FOUND              = 4040000101;
    case CLIENT_NOT_FOUND_ERROR = 4040000102;

    // 405 - 用来访问本页面的 HTTP 谓词不被允许（方法不被允许）
    case CLIENT_METHOD_NOT_ALLOWED_ERROR = 4050000101;

    // 406 - 客户端浏览器不接受所请求页面的 MIME 类型
    // 407 - 要求进行代理身份验证
    // 412 - 前提条件失败
    // 413 – 请求实体太大
    // 414 - 请求 URI 太长
    // 415 – 不支持的媒体类型
    // 416 – 所请求的范围无法满足
    // 417 – 执行失败
    // 423 – 锁定的错误

    // 422 - 参数验证失败
    case CLIENT_PARAMETER_ERROR = 4220000101;

    // 429 – 请求频繁
    case CLIENT_TOO_MANY_REQUESTS = 4290000101;

    // 500 - 网络开小差
    case NETWORK_GLITCH = 5000000101;

    public function message(): string
    {
        return match ($this) {
            self::CLIENT_BAD_REQUEST_ERROR                   => '请求失败',
            self::CLIENT_PARAMETER_ERROR                     => '参数错误',
            self::CLIENT_CREATED_ERROR                       => '数据已存在',
            self::CLIENT_DELETED_ERROR                       => '数据不存在',
            self::CLIENT_HTTP_UNAUTHORIZED_ERROR             => '未授权，请先登录',
            self::CLIENT_HTTP_UNAUTHORIZED_EXPIRED_ERROR     => '账号信息已过期，请重新登录',
            self::CLIENT_HTTP_UNAUTHORIZED_BLACKLISTED_ERROR => '账号在其他设备登录，请重新登录',
            self::CLIENT_FORBIDDEN_ERROR                     => '无权限访问',
            self::CLIENT_NOT_FOUND_ERROR                     => '{title}不存在',
            self::CLIENT_METHOD_NOT_ALLOWED_ERROR            => 'HTTP请求类型错误',
            self::CLIENT_TOO_MANY_REQUESTS                   => '操作过于频繁，请稍后重试',
            self::NETWORK_GLITCH                             => '网络开小差',
            self::NOT_FOUND                                  => '未定义路由',
            self::RESOURCE_TYPE_ERROR                        => '相应字段类型{type}未定义',
        };
    }

    public function statusCode(): int
    {
        return match ($this) {
            self::CLIENT_BAD_REQUEST_ERROR, self::CLIENT_CREATED_ERROR, self::CLIENT_DELETED_ERROR, self::CLIENT_NOT_FOUND_ERROR, self::RESOURCE_TYPE_ERROR => 400,
            self::CLIENT_HTTP_UNAUTHORIZED_ERROR, self::CLIENT_HTTP_UNAUTHORIZED_EXPIRED_ERROR, self::CLIENT_HTTP_UNAUTHORIZED_BLACKLISTED_ERROR => 401,
            self::CLIENT_FORBIDDEN_ERROR          => 403,
            self::NOT_FOUND                       => 404,
            self::CLIENT_METHOD_NOT_ALLOWED_ERROR => 405,
            self::CLIENT_PARAMETER_ERROR          => 422,
            self::CLIENT_TOO_MANY_REQUESTS        => 429,
            self::NETWORK_GLITCH                  => 500,
        };
    }
}
