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
        Schema::create('flow_node_tasks', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->ulid('approver_id')->comment('审批人ID')->index('idx_approver_id');
            $table->string('approver_name')->comment('审批人名称');
            $table->json('operation_info')->nullable()->comment('操作信息');
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'transferred',
                'forwarded',
                'add_signed',
                'skipped',
                'auto',
                'canceled',
            ])->comment('状态[pending:待处理,approved:已同意,rejected:已拒绝,transferred:已转交,forwarded:已转交,add_signed:已加签,skipped:已跳过,auto:自动处理,canceled:已取消]');
            $table->ulid('flow_node_id')->comment('审批节点ID')->index('idx_flow_node_id');
            $table->json('extend')->nullable()->comment('额外信息');
            MigrationHelper::time($table);
            $table->comment('流程节点任务实例表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_node_tasks');
    }
};
