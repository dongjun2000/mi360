<?php

namespace App\Http\View\Composers;

use App\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $categories = Category::query()->where('ishome', true)->get();
        $view->with('categories', $categories);
    }
}