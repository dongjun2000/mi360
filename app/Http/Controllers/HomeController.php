<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * 为你推荐
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Article $article)
    {
        $tag = 'index';

        $articles = $article->comment();

        return view('home', compact('tag', 'articles'));
    }

    /**
     * 近期热门
     *
     * @param Article $article
     * @param null $time
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hottest(Article $article, $time = null)
    {
        $tag = 'hottest';

        $articles = $article->hottest($time);

        return view('home', compact('tag','time', 'articles'));
    }

    /**
     * 最新内容
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newest(Article $article)
    {
        $tag = 'newest';

        $articles = $article->newest();

        return view('home', compact('tag', 'articles'));
    }

    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channel($name)
    {
        $tag = 'channel';

        $category = Category::where('name', $name)->first();
        $articles = $category->articles()->with('user')->paginate(10);

        return view('home', compact('tag', 'category', 'articles'));
    }
}
