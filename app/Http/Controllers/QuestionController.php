<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use App\Events\QuestionCollect;
use App\Http\Requests\QuestionStore;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['index', 'show', 'hotQuestions', 'unanswered']);
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
    public function store(QuestionStore $request)
    {
        $question = Auth::user()->questions()->create([
            'title'              => $request->get('title'),
            'content'            => $request->get('content'),
            'laster_answer_user' => [
                'id'         => Auth::user()->id,
                'name'       => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
                'type'       => 0,    // 创建
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
        // 触发事件
        event('article.read', $question);

        $collectStatus = false;     // 收藏状态
        if (Auth::check()) {
            $collectStatus = $question->isCollect(Auth::user()->id);
        }

        // 回答列表
        $answers = $question->answers()->with('user')->orderByDesc('accept')->orderByDesc('updated_at')->get();

        return view('questions.show', compact('question', 'answers', 'collectStatus'));
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

    /**
     * 收藏与取消收藏
     *
     * @param Question $question
     * @return $this
     */
    public function collect(Question $question)
    {
        $result = $question->collects()->toggle(Auth::user());

        $is_collect = (bool)count($result['attached']);

        event(new QuestionCollect($question, $is_collect));

        return back();
    }
}
