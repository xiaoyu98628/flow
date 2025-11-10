<?php

namespace App\Http\Controllers\V1;

use App\Constants\Response\ClientFailedCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        return ResponseHelper::fail(code: ClientFailedCode::CLIENT_NOT_FOUND_ERROR, format: ['title' => '名称']);
    }

    public function store()
    {
        return ResponseHelper::success();
    }
}
