<?php

namespace App\Http\Controllers\V1;

use App\Constants\Response\Demo\TestCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        return ResponseHelper::fail(code: TestCode::ERROR);
    }

    public function store()
    {
        return ResponseHelper::success();
    }
}
