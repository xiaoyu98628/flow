<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    /**
     * 操作者和时间
     * @param  Blueprint  $table
     * @return void
     */
    public static function operatorAndTime(Blueprint $table): void
    {
        $table->dateTime('created_at')->nullable()->comment('创建时间')->index('idx_created_at');
        $table->ulid('created_operator_id')->nullable()->comment('创建者编号');
        $table->dateTime('updated_at')->nullable()->comment('更新时间');
        $table->ulid('updated_operator_id')->nullable()->comment('更新者编号');
        $table->dateTime('deleted_at')->nullable()->comment('删除时间');
        $table->ulid('deleted_operator_id')->nullable()->comment('删除者编号');
    }

    /**
     * 时间
     * @param  Blueprint  $table
     * @return void
     */
    public static function time(Blueprint $table): void
    {
        $table->dateTime('created_at')->nullable()->comment('创建时间')->index('idx_created_at');
        $table->dateTime('updated_at')->nullable()->comment('更新时间');
        $table->dateTime('deleted_at')->nullable()->comment('删除时间');
    }
}
