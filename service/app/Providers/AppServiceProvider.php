<?php

namespace App\Providers;

use App\Helpers\DbLoggerHelper;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // SQL查询日志
        DbLoggerHelper::enable();
        // 项目中所有多态关联都使用ULID
        Builder::defaultMorphKeyType('ulid');
    }
}
