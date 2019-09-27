<?php

namespace App\Http\Controllers;

use Auth;
use App\Answer;
use App\Events\QuestionAnswer;
use App\Http\Requests\AnswerStore;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
     * 添加新的答案
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerStore $request)
    {
        Auth::user()->answers()->create($request->all());

        return back()->with('success', '发表成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * 更新答案页面
     *
     * @param Answer $answer
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Answer $answer)
    {
        $this->authorize('update', $answer);
    }

    /**
     *
     * 更新答案操作
     *
     * @param Request $request
     * @param Answer $answer
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Answer $answer)
    {
        $this->authorize('update', $answer);
    }

    /**
     * 删除答案操作
     *
     * @param Answer $answer
     * @return $this
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        return back()->with('success', '删除成功！');
    }
}
