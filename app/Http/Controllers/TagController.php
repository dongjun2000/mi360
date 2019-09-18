<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * 标签列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->with('tags')->get();

        return view('tags.index', compact('categories'));
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
     * 标签详情页
     *
     * @param Request $request
     * @param string $name 标签名
     */
    public function show(Request $request, $name)
    {
        $label = 'show';
        $tag   = Tag::query()->where('name', $name)->first();
        return view('tags.show', compact('tag', 'label'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }

    /**
     * 标签相关问答
     *
     * @param Request $request
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questions(Request $request, $name)
    {
        $label = 'questions';
        $tag   = Tag::query()->where('name', $name)->first();

        $items = $tag->questions()->paginate(10);

        return view('tags.show', compact('tag', 'items', 'label'));
    }

    /**
     * 标签相关文章
     *
     * @param Request $request
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article(Request $request, $name)
    {
        $label = 'article';
        $tag   = Tag::query()->where('name', $name)->first();

        $items = $tag->articles()->with('user:id,name,avatar')->paginate(10);

        return view('tags.show', compact('tag', 'items', 'label'));
    }

    /**
     * 标签百科
     *
     * @param Request $request
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request, $name)
    {
        $label = 'info';
        $tag   = Tag::query()->where('name', $name)->first();
        return view('tags.show', compact('tag', 'label'));
    }
}
