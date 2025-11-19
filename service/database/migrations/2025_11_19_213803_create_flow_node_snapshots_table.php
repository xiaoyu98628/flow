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
        Schema::create('flow_node_snapshots', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->ulid('flow_version_template_id')->comment('流程版本模版ID');
            $table->json('snapshot')->comment('节点快照');
            MigrationHelper::operatorAndTime($table);
            $table->index('flow_template_version_id');
            $table->comment('流程节点快照表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_node_snapshots');
    }
};
