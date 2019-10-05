<?php

namespace App\Providers;

use App\Http\View\Composers\ActivityComposer;
use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\UserComposer;
use App\Http\View\Composers\VisitorComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册视图合成器
        View::composer(['user.show'], UserComposer::class);
        View::composer('includes.category', CategoryComposer::class);
        View::composer('includes.visitor', VisitorComposer::class);
        View::composer('includes.activities', ActivityComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
