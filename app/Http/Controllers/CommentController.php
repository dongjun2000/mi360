<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStore;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
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
     * 保存评论操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStore $request)
    {
//        dd($request->all());
        Auth::user()->comments()->create($request->all());

        return back()->with('success', '评论成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * 更新评论页面
     *
     * @param Comment $comment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
    }

    /**
     * 更新评论操作
     *
     * @param Request $request
     * @param Comment $comment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
    }

    /**
     * 删除评论
     *
     * @param Comment $comment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
    }

    public function reply()
    {
        echo 'reply';
    }
}
