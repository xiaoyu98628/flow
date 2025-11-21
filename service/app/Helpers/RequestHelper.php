<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class RequestHelper
{
    /**
     * 获取指定参数
     * @param  array  $fields  字段和默认值映射数组
     * @param  string  $param  参数名
     * @return array
     */
    public static function getInputs(array $fields = [], string $param = ''): array
    {
        if (empty($param)) {
            $inputs = request()->all();
        } else {
            $inputs = request()->input($param, []);
            // 如果获取的不是数组，转换为数组
            if (! is_array($inputs)) {
                $inputs = [$inputs];
            }
        }

        $result = self::arrayDefault($inputs, $fields);

        // 处理分页参数
        return self::mergePaginationParams($result);
    }

    /**
     * 获取指定参数 f.
     * @param  array  $fields  字段和默认值映射数组
     * @return array
     */
    public static function getInputsF(array $fields = []): array
    {
        return self::getInputs($fields, 'f');
    }

    /**
     * 获取查询字符串参数
     * @param  array  $fields  字段和默认值映射数组
     * @return array
     */
    public static function getQueryInputs(array $fields = []): array
    {
        $inputs = request()->query();
        $result = self::arrayDefault($inputs, $fields);

        // 处理分页参数
        return self::mergePaginationParams($result);
    }

    /**
     * 获取路由参数
     * @param  array  $fields  字段和默认值映射数组
     * @return array
     */
    public static function getRouteInputs(array $fields = []): array
    {
        $routeParams = request()->route() ? request()->route()->parameters() : [];

        return self::arrayDefault($routeParams, $fields);
    }

    /**
     * 获取文件
     * @param  string  $key  文件字段名
     * @return UploadedFile|UploadedFile[]|UploadedFile[][]|null
     */
    public static function getFile(string $key): array|UploadedFile|null
    {
        return request()->file($key);
    }

    /**
     * 数组默认值处理
     * @param  array  $data  原始数据
     * @param  array  $fields  字段和默认值映射数组
     * @return array
     */
    private static function arrayDefault(array $data, array $fields = []): array
    {
        $result = [];
        if (empty($fields)) {
            $result = $data;
        } else {
            foreach ($fields as $field => $default) {
                if (isset($data[$field])) {
                    $result[$field] = $data[$field];
                } else {
                    $result[$field] = $default;
                }
            }
        }

        return $result;
    }

    /**
     * 合并分页参数
     * @param  array  $result
     * @return array
     */
    private static function mergePaginationParams(array $result): array
    {
        $request = request();
        if ($request->has('page')) {
            $result['page']      = $request->input('page', 1);
            $result['page_size'] = $request->input('page_size', 15);
        }

        return $result;
    }
}
