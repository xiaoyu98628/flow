<?php

use App\Helpers\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flow_templates', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->enum('type', ['general'])->comment('类型[general:通用审批]');
            $table->string('code', 50)->comment('标识');
            $table->string('name', 50)->comment('名称');
            $table->string('remark')->nullable()->comment('备注');
            $table->unsignedInteger('current_version')->default(0)->comment('已发布版本号');
            $table->enum('status', ['enable', 'disable'])->default('enable')->comment('状态[enable:启用,disable:禁用]');
            MigrationHelper::operatorAndTime($table);
            $table->index(['type', 'code'], 'idx_type_code');
            $table->comment('流程模版表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_templates');
    }
};
