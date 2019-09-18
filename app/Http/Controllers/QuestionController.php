<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['index', 'show' ,'hotQuestions', 'unanswered']);
    }

    /**
     * 热门问题
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hotQuestions()
    {
        $category = 'hot';

        $questions = Question::query()->where('hot', true)->orderBy('updated_at', 'DESC')->paginate(10);

        return view('questions.index', compact('category', 'questions'));
    }

    /**
     * 未回答的问题
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unanswered()
    {
        $category = 'unanswered';

        $questions = Question::query()->where('status', '!=', 2)->orderBy('updated_at', 'DESC')->paginate(10);

        return view('questions.index', compact('category', 'questions'));
    }

    /**
     * 最新问答
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $category = 'index';

        $questions = Question::query()->orderBy('updated_at', 'DESC')->with('tags')->paginate(10);

        return view('questions.index', compact('category', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Auth::user()->questions()->create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'laster_answer_user' => [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
                'type' => 0,    // 创建
            ],
        ]);

        return redirect()->route('questions.show', $question);
    }

    /**
     * 显示问答详情
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
