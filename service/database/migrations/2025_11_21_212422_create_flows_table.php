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
        Schema::create('flows', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->string('title', 60)->comment('标题');
            $table->enum('type', ['general'])->comment('类型[general:通用审批]');
            $table->string('code', 50)->comment('标识');
            $table->ulid('parent_flow_id')->nullable()->comment('父级流程ID')->index('idx_parent_flow_id');
            $table->ulid('parent_node_id')->nullable()->comment('父级节点ID')->index('idx_parent_node_id');
            $table->enum('level', ['main', 'subflow'])->comment('层级[main:主流程,subflow:子流程]');
            $table->ulid('business_id')->comment('业务ID')->index('idx_business_id');
            $table->json('business_snapshot')->nullable()->comment('业务快照');
            $table->enum('status', [
                'created',
                'processing',
                'waiting',
                'approved',
                'rejected',
                'canceled',
            ])->comment('状态[created:已创建,processing:进行中,waiting:等待中,approved:已通过,rejected:已驳回,canceled:已取消]');
            $table->json('callback')->nullable()->comment('回调');
            $table->ulid('applicant_id')->comment('申请人ID')->index('idx_applicant_id');
            $table->json('extend')->nullable()->comment('额外信息');
            $table->ulid('flow_version_template_id')->comment('流程版本模版ID');
            MigrationHelper::time($table);
            $table->comment('审批实例表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flows');
    }
};
