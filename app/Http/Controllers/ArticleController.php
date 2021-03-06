<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\Category;
use App\Events\ArticleZan;
use App\Events\ArticleCollect;
use App\Http\Requests\ArticleSotre;
use App\Notifications\NewArticleZan;
use App\Notifications\NewArticleCollect;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified')
            ->except(['index', 'show', 'hotArticle', 'newArticle']);
    }

    /**
     * 获取热门的文章列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hotArticle(Article $article)
    {
        $category = 'hot';

        $articles = $article->hottest();

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * 获取最新的文章列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newArticle(Article $article)
    {
        $category = 'new';

        $articles = $article->newest();

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * 获取推荐的文章列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article)
    {
        $category = 'index';
        $articles = $article->comment();

        return view('article.index', compact('articles', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->get(['id', 'name']);

        return view('article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleSotre $request)
    {
        $article = Auth::user()->articles()->create([
            'category_id' => $request->get('category_id'),
            'type'        => $request->get('type'),
            'title'       => $request->get('title'),
            'content'     => $request->get('content'),
            'intro'       => mb_substr(preg_replace('/\r\n|\r|\n+/', '', strip_tags($request->get('content'))), 0, 100),
        ]);

        $article->tags()->attach($request->get('tags'));

        return redirect()->route('articles.show', $article);
    }

    /**
     * 查看文章详情
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // 分发事件 - 阅读数自增
        event('article.read', $article);

        $zanStatus     = false;
        $collectStatus = false;
        $followStatus = false;
        if (Auth::check()) {
            $zanStatus     = $article->isZan(Auth::user()->id);
            $collectStatus = $article->isCollect(Auth::user()->id);
            $followStatus = $article->user->isFollow(Auth::user()->id);
        }

        // 按pid分组
        $comments = $article->comments()->with('user')->orderBy('created_at')->get()->groupBy('pid');

        return view('article.show', compact('article', 'comments', 'zanStatus', 'collectStatus', 'followStatus'));
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

    /**
     * 收藏与取消收藏
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function collect(Article $article)
    {
        $result = $article->collects()->toggle(Auth::user());

        $is_collect = count($result['attached']) ? true : false;

        event(new ArticleCollect($article, $is_collect));

        $article->user->notify(new NewArticleCollect(Auth::user(), $article, $is_collect));

        return back();
    }

    /**
     * 文章点赞与取消点赞
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function zans(Article $article)
    {
        $result = $article->zans()->toggle(Auth::user());

        $is_zan = count($result['attached']) ? true : false;

        event(new ArticleZan($article, $is_zan));

        $article->user->notify(new NewArticleZan(Auth::user(), $article, $is_zan));

        return back();
    }
}
