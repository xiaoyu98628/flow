<?php

declare(strict_types=1);

namespace App\Constants\Response;

interface ShortCode
{
    /**
     * 获取短 code
     * @note getCode
     * @return int
     * @author zouxiang
     */
    public function getCode(): int;

    /**
     * 项目 code
     * @note projectCode
     * @return string
     * @author zouxiang
     */
    public function projectCode(): string;
}
