<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    /**
     * 添加操作者ID和时间戳字段（软删除版本）
     * @param  Blueprint  $table
     * @param  bool  $indexCreatedAt
     * @return void
     */
    public static function timestampsWithOperators(Blueprint $table, bool $indexCreatedAt = true): void
    {
        $table->dateTime('created_at')->nullable()->comment('创建时间');
        $table->ulid('created_operator_id')->nullable()->comment('创建者编号');
        $table->dateTime('updated_at')->nullable()->comment('更新时间');
        $table->ulid('updated_operator_id')->nullable()->comment('更新者编号');
        $table->dateTime('deleted_at')->nullable()->comment('删除时间');
        $table->ulid('deleted_operator_id')->nullable()->comment('删除者编号');

        if ($indexCreatedAt) {
            $table->index('created_at', 'idx_created_at');
        }
    }

    /**
     * 添加标准时间戳字段（软删除版本）
     * @param  Blueprint  $table
     * @param  bool  $indexCreatedAt
     * @return void
     */
    public static function timestampsWithSoftDeletes(Blueprint $table, bool $indexCreatedAt = true): void
    {
        $table->dateTime('created_at')->nullable()->comment('创建时间');
        $table->dateTime('updated_at')->nullable()->comment('更新时间');
        $table->dateTime('deleted_at')->nullable()->comment('删除时间');

        if ($indexCreatedAt) {
            $table->index('created_at', 'idx_created_at');
        }
    }

    /**
     * 添加基本时间戳字段
     * @param  Blueprint  $table
     * @param  bool  $indexCreatedAt
     * @return void
     */
    public static function timestamps(Blueprint $table, bool $indexCreatedAt = true): void
    {
        $table->dateTime('created_at')->nullable()->comment('创建时间');
        $table->dateTime('updated_at')->nullable()->comment('更新时间');

        if ($indexCreatedAt) {
            $table->index('created_at', 'idx_created_at');
        }
    }
}
