<?php

declare(strict_types=1);

namespace App\Helpers;

class EncryptionHelper
{
    /**
     * 将数组数据进行编码
     * @param  array  $data
     * @return string
     */
    public static function encrypt(array $data): string
    {
        return str_replace('=', '', base64_encode(urlencode(json_encode($data, 1))));
    }

    /**
     * 解码给定的字符串
     * @param  string  $data
     * @return array
     */
    public static function decrypt(string $data): array
    {
        if (empty($data)) {
            return [];
        }

        if (str_contains($data, ' ')) {
            $data = str_replace(' ', '+', $data);
        }
        $jsonStr = urldecode(base64_decode($data));

        return json_decode($jsonStr, true) ?: [];

    }
}
