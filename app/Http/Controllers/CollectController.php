<?php

namespace App\Http\Controllers;

use App\Events\ArticleCollect;
use Auth;
use App\Article;
use App\Collect;
use Illuminate\Http\Request;

class CollectController extends Controller
{
    /**
     * 收藏与取消收藏
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function article(Article $article)
    {
        $result = $article->collects()->toggle(Auth::user());

        $is_collect = count($result['attached']) ? true : false;

        event(new ArticleCollect($article, $is_collect));

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collect $collect
     * @return \Illuminate\Http\Response
     */
    public function show(Collect $collect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collect $collect
     * @return \Illuminate\Http\Response
     */
    public function edit(Collect $collect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Collect $collect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collect $collect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collect $collect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collect $collect)
    {
        //
    }
}
