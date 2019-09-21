<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['show', 'articles']);
    }

    /**
     * 关注与取关
     *
     * @param User $user
     * @return $this
     */
    public function follow(User $user)
    {
        $user->followToggle(Auth::user()->id);

        return back()->with('success', '关注成功!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $tag = 'show';
        return view('user.show', compact('tag', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * 我的文章列表
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles(Request $request, User $user)
    {
        $tag = 'articles';

        // 排序参数处理
        $sort = $request->get('sort', 'created_at');
        $sort = in_array($sort, ['created_at', 'read', 'collect', 'zan']) ? $sort : 'created_at';

        $articles = $user->articles()->orderByDesc($sort)->paginate(10);

        return view('user.articles', compact('tag', 'user', 'articles'));
    }

    /**
     * 我的提问
     *
     * @param User $user
     */
    public function questions(User $user)
    {

    }

    /**
     * 我的回答
     *
     * @param User $user
     */
    public function answers(User $user)
    {

    }

    /**
     * 我的收藏
     *
     * @param User $user
     */
    public function collects(User $user)
    {

    }
}
