<?php

use App\Helpers\MigrationHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->string('log_name')->nullable()->comment('日志名称');
            $table->text('description')->comment('描述');
            $table->nullableMorphs('subject', 'idx_subject');
            $table->nullableMorphs('causer', 'idx_causer');
            $table->json('properties')->nullable()->comment('其他属性');
            MigrationHelper::timestamps($table);
            $table->comment('系统操作日志表');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
};
