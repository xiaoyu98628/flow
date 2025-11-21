<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Constants\Response\Code;
use App\Constants\Response\FailedCode\ClientFailedCode;
use App\Constants\Response\FailedCode\SuccessCode;
use App\Constants\Response\ResponseMsg;
use App\Constants\Response\ShortCode;
use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(mixed $data = null, Code $code = SuccessCode::SUCCESS_OK, ?string $message = null): JsonResponse
    {
        $message = $message ?? ($code == SuccessCode::SUCCESS_OK ? ResponseMsg::from(request()->method())->successMsg() : $code->message());

        return self::_jsonResponse(status: true, code: $code, data: $data, message: $message ?? '');
    }

    public static function fail(Code $code = ClientFailedCode::CLIENT_BAD_REQUEST_ERROR, mixed $data = null, ?string $message = null, array $format = []): JsonResponse
    {
        $message = $message ?? ($code == ClientFailedCode::CLIENT_BAD_REQUEST_ERROR ? ResponseMsg::from(request()->method())->errMsg() : $code->message());
        if (! empty($format)) {
            $message = StrHelper::formatStr($message, $format);
        }

        return self::_jsonResponse(status: false, code: $code, data: $data, message: $message);
    }

    private static function _jsonResponse(bool $status, Code $code, mixed $data, string $message = ''): JsonResponse
    {
        $responseCode = $code instanceof ShortCode ? $code->getCode() : $code;

        return response()->json(data: ['success' => $status, 'code' => $responseCode, 'message' => $message, 'data' => $data, 'trace_id' => app(abstract: 'request')->header('H-TraceId')], status: $code->statusCode());
    }
}
