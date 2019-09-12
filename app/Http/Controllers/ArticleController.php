<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\Http\Requests\ArticleSotre;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * 获取热门的文章列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hotArticle()
    {
        $category = 'hot';
        $articles = Article::query()
            ->orderByDesc('id')
            ->show()
            ->hot()
            ->paginate(10);

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * 获取最新的文章列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newArticle()
    {
        $category = 'new';
        $articles = Article::query()
            ->orderByDesc('id')
            ->show()
            ->paginate(10);

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * 获取推荐的文章列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = 'commend';
        $articles = Article::query()
            ->orderByDesc('id')
            ->show()
            ->comment()
            ->with('user')
            ->paginate(10);

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleSotre $request)
    {

        $article = \Auth::user()->articles()->create([
            'type'    => $request->get('type'),
            'title'   => $request->get('title'),
            'content' => $request->get('content'),
            'intro'   => mb_substr(strip_tags($request->get('content')), 0, 100),
        ]);

        return redirect()->route('article.show', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
//        dd($article);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
