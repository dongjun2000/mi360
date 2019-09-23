<?php

namespace App\Providers;

use App\Answer;
use App\Article;
use App\Question;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 自定义多态类型
        Relation::morphMap([
            'articles'  => Article::class,
            'questions' => Question::class,
            'answers'   => Answer::class,
        ]);
    }
}
