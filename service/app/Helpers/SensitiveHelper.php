<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Constants\Response\FailedCode\SensitiveFailedCode;
use App\Exceptions\BusinessException;

/**
 * 敏感数据处理
 * Class SensitiveHelper
 */
class SensitiveHelper
{
    /**
     * @note AES加密
     * 使用AES-256-CBC算法对输入数据进行加密
     * @param  string  $str
     * @return string
     * @throws BusinessException|\Random\RandomException
     */
    public static function encrypt(string $str): string
    {
        $key    = config('system.aes.key', '');
        $cipher = config('system.aes.cipher', '');

        // 生成长度符合算法要求的 IV
        $ivLength = openssl_cipher_iv_length($cipher);
        $iv       = random_bytes($ivLength);

        if (empty($key) || empty($cipher)) {
            throw new BusinessException(responseCode: SensitiveFailedCode::AES_KEY_EMPTY);
        }

        $ciphertext = openssl_encrypt($str, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        return base64_encode($iv.$ciphertext);
    }

    /**
     * @note AES解密
     * 使用AES-256-CBC算法对输入数据进行解密
     * @param  string  $str
     * @return string
     * @throws BusinessException
     */
    public static function decrypt(string $str): string
    {
        $key    = config('system.aes.key', '');
        $cipher = config('system.aes.cipher', '');

        if (empty($key) || empty($cipher)) {
            throw new BusinessException(responseCode: SensitiveFailedCode::AES_KEY_EMPTY);
        }

        $data = base64_decode($str);

        if ($data === false) {
            throw new BusinessException(responseCode: SensitiveFailedCode::AES_DECRYPT_FAILED);
        }

        $ivLength = openssl_cipher_iv_length($cipher);

        // 拆分出 iv 和 ciphertext
        $iv         = substr($data, 0, $ivLength);
        $ciphertext = substr($data, $ivLength);

        $plaintext = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        if ($plaintext === false) {
            throw new BusinessException(responseCode: SensitiveFailedCode::AES_DECRYPT_FAILED);
        }

        return $plaintext;
    }
}
