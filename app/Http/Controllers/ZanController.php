<?php

namespace App\Http\Controllers;

use Auth;
use App\Zan;
use App\Article;
use App\Events\ArticleZan;
use Illuminate\Http\Request;

class ZanController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * 文章点赞与取消点赞
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function article(Article $article)
    {
        $result = Auth::user()->zans()->toggle($article);

        // 赞或取消点赞
        $is_zan = count($result['attached']) ? true : false;

        event(new ArticleZan($article, $is_zan));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zan  $zan
     * @return \Illuminate\Http\Response
     */
    public function show(Zan $zan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zan  $zan
     * @return \Illuminate\Http\Response
     */
    public function edit(Zan $zan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zan  $zan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zan $zan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zan  $zan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zan $zan)
    {
        //
    }
}
