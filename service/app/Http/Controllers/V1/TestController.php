<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Constants\Response\FailedCode\SensitiveFailedCode;
use App\Helpers\ResponseHelper;
use App\Helpers\SensitiveHelper;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        $c = SensitiveHelper::encrypt('15255796128');
        $d = SensitiveHelper::decrypt($c);

        return ResponseHelper::fail(code: SensitiveFailedCode::AES_DECRYPT_FAILED);
    }

    public function store()
    {
        return ResponseHelper::success();
    }
}
