<?php

declare(strict_types=1);

use App\Constants\Response\FailedCode\ClientFailedCode;
use App\Exceptions\BusinessException;
use App\Helpers\ResponseHelper;
use App\Http\Middleware\DecodeRequestMiddleware;
use App\Http\Middleware\JsonMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\TrustHosts;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('common')->as('common.')->group(base_path('routes/common.php'));
        }
    )->withMiddleware(function (Middleware $middleware): void {
        $middleware->use([
            // 处理CORS
            HandleCors::class,
            // 处理代理服务器场景下的请求信息信任问题
            TrustProxies::class,
            // 处理请求信息信任问题
            TrustHosts::class,
            // 参数解密
            DecodeRequestMiddleware::class,
            // JSON格式化
            JsonMiddleware::class,
        ]);
    })->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (Exception $exception) {

            // 数据验证
            if ($exception instanceof ValidationException) {
                return ResponseHelper::fail(code: ClientFailedCode::CLIENT_PARAMETER_ERROR, data: $exception->errors());
            }
            // 路由不存在
            if ($exception instanceof NotFoundHttpException) {
                return ResponseHelper::fail(code: ClientFailedCode::NOT_FOUND, data: $exception->getMessage());
            }
            // 业务异常
            if ($exception instanceof BusinessException) {
                return ResponseHelper::fail(code: $exception->responseCode, message: $exception->responseMessage);
            }

            return false;
        });
    })->create();
