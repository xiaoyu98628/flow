<?php

declare(strict_types=1);

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
        Schema::create('flow_template_versions', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('主键');
            $table->ulid('flow_template_id')->comment('流程模版ID');
            $table->unsignedInteger('version')->nullable()->default(0)->comment('版本号[递增]');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->comment('状态[draft:草稿, published:已发布, archived:已归档]');
            $table->string('name', 100)->nullable()->comment('名称');
            $table->json('callback')->nullable()->comment('回调');
            $table->json('extend')->nullable()->comment('额外信息');
            MigrationHelper::timestampsWithOperators($table);
            $table->unique(['flow_template_id', 'version'], 'idx_template_id_version');
            $table->comment('流程模版版本表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_template_versions');
    }
};
