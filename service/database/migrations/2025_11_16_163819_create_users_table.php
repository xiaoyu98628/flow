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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('ID');
            $table->bigInteger('number')->comment('用户号');
            $table->string('avatar')->comment('头像');
            $table->string('nickname', 50)->comment('昵称');
            $table->tinyInteger('gender')->nullable()->comment('性别[0:未知,1:男,2:女]');
            $table->string('signature', 255)->comment('个性签名');
            $table->string('country_code', 20)->comment('国家代码');
            $table->string('dialing_code', 20)->default('86')->comment('拨号区号');
            $table->string('mobile', 20)->comment('手机号[脱敏]');
            $table->string('mobile_encryption', 255)->comment('手机号[加密]');
            $table->string('email')->nullable()->comment('邮箱[脱敏]');
            $table->string('email_encryption')->nullable()->comment('邮箱[加密]');
            $table->string('password', 255)->comment('密码');
            $table->string('status', 255)->default('activation')->comment('状态[activation:激活,locking:锁定,cancelled:注销,leave:离职]');
            MigrationHelper::timestampsWithSoftDeletes($table);
            $table->comment('用户表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
