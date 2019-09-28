<?php

namespace App\Http\View\Composers;

use App\Activity;
use Illuminate\View\View;

class ActivityComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $activities = Activity::query()->orderByDesc('created_at')->limit(20)->get();

        $view->with('activities', $activities);
    }
}