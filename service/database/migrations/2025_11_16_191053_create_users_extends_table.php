<?php

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
        Schema::create('user_extends', function (Blueprint $table) {
            $table->ulid('user_id')->primary();
            $table->dateTime('mobile_verified_at')->nullable()->comment('手机验证时间');
            $table->dateTime('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->json('mobile_location')->nullable()->comment('号码归属地');
            $table->string('mobile_location_province', 255)->nullable()->comment('号码归属地省份');
            $table->string('mobile_location_city', 255)->nullable()->comment('号码归属地城市');
            $table->json('extend')->nullable()->comment('额外信息');
            $table->string('register_ip', 255)->nullable()->comment('注册IP');
            $table->string('register_city', 255)->nullable()->comment('注册城市');
            $table->dateTime('register_at')->nullable()->comment('注册时间');
            $table->bigInteger('login_count')->default(0)->comment('登录次数');
            $table->dateTime('last_login_at')->nullable()->comment('最后一次登陆时间');
            $table->string('last_login_ip', 255)->nullable()->comment('最后一次登录IP');
            $table->string('last_login_city', 255)->nullable()->comment('最后一次登录地址');
            MigrationHelper::time($table);
            $table->comment('用户扩展表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_extends');
    }
};
