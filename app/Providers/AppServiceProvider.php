<?php

namespace App\Providers;

use App\Helpers\CommonHelper;
use App\Models\Industry;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        $workTypes = CommonHelper::jobWorkType();

        $parentIds = Industry::whereNull('parent_id')->get()->pluck('id')->toArray();
        $industries = Industry::whereIn('id', $parentIds)->with('childrens')->get();

        View::share('workTypes', $workTypes);
        View::share('industries', $industries);
    }
}
