<?php

declare(strict_types=1);

/**
 * @note system
 * @author captionwy
 */
return [
    'client_id'    => env('USER_CLIENT_ID', null), // client_id
    'project_code' => env('PROJECT_CODE', '101'), // 错误码
    'aes'          => [
        'key'    => env('AES_KEY', ''), // 密钥
        'cipher' => env('AES_CIPHER', 'AES-256-CBC'), // 密码学
    ],
];
