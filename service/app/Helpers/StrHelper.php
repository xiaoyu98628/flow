<?php

namespace App\Helpers;

class StrHelper
{
    /**
     * 字符串模版转化
     * @note  表 {a} 字段 {b} 缺失 实例: 表 h_user 字段 name 缺失
     * @param  string  $str
     * @param  array  $format
     * @return string
     */
    public static function formatStr(string $str, array $format): string
    {
        return collect($format)->reduce(function ($carry, $value, $key) {
            return str_replace('{' . $key . '}', $value, $carry);
        }, $str);
    }
}
