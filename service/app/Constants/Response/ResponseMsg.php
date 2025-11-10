<?php

declare(strict_types=1);

namespace App\Constants\Response;

enum ResponseMsg: string
{
    case METHOD_GET    = 'GET';
    case METHOD_POST   = 'POST';
    case METHOD_PUT    = 'PUT';
    case METHOD_DELETE = 'DELETE';

    /**
     * @note 统一错误提示
     * @return string
     *
     * @author eva
     */
    public function errMsg(): string
    {
        return match ($this) {
            ResponseMsg::METHOD_POST   => '保存失败',
            ResponseMsg::METHOD_PUT    => '操作失败',
            ResponseMsg::METHOD_DELETE => '删除失败',
            default                    => '请求失败',
        };
    }

    /**
     * @note 统一成功提示
     * @return string
     *
     * @author eva
     */
    public function successMsg(): string
    {
        return match ($this) {
            ResponseMsg::METHOD_POST   => '保存成功',
            ResponseMsg::METHOD_PUT    => '操作成功',
            ResponseMsg::METHOD_DELETE => '删除成功',
            default                    => '',
        };
    }
}
