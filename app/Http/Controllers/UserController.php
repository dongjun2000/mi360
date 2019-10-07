<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Events\UserShow;
use App\Events\UserFollow;
use Illuminate\Http\Request;
use App\Http\Requests\UserSettings;
use App\Notifications\NewUserFollow;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['show', 'articles', 'questions', 'answers', 'collects']);
    }

    /**
     * 关注与取关
     *
     * @param User $user
     * @return $this
     */
    public function follow(User $user)
    {
        $result = $user->followToggle(Auth::user()->id);

        $is_follow = count($result['attached']) ? true : false;

        event(new UserFollow($user, Auth::user(), $is_follow));

        $user->notify(new NewUserFollow(Auth::user(), $is_follow));

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
        $tag = 'activities';

        $activities = $user->activities()->orderByDesc('created_at')->paginate(20);

        event(new UserShow($user));

        return view('user.show', compact('tag', 'user', 'activities'));
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

        $articles = $user->articles()->with('user')->orderByDesc($sort)->paginate(10);

        return view('user.show', compact('tag', 'user', 'articles'));
    }

    /**
     * 我的提问
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questions(Request $request, User $user)
    {
        $tag = 'questions';

        // 排序参数处理
        $sort = $request->get('sort', 'created_at');
        $sort = in_array($sort, ['created_at', 'answer', 'follow', 'read']) ? $sort : 'created_at';

        $questions = $user->questions()->orderByDesc($sort)->paginate(10);

        return view('user.show', compact('tag', 'user', 'questions'));
    }

    /**
     * 我的回答
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function answers(Request $request, User $user)
    {
        $tag = 'answers';

        // 排序参数处理
        $sort = $request->get('sort', 'created_at');
        $sort = in_array($sort, ['created_at', 'accept']) ? $sort : 'created_at';

        $answers = $user->answers()->with('question')->orderByDesc($sort)->paginate(10);

        return view('user.show', compact('tag', 'user', 'answers'));
    }

    /**
     * 我的收藏
     *
     * @param User $user
     */
    public function collects(Request $request, User $user)
    {
        $tag = 'collects';

        $type = $request->get('type', 'articles');

        if (!in_array($type, ['articles', 'questions'])) {
            abort(404, '参数错误！');
        }

        $models = $user->collects($type)->paginate(20);

        return view('user.show', compact('tag','type', 'user', 'models'));
    }

    /**
     * 设置个人资料页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $user = Auth::user();

        return view('user.settings', compact('user'));
    }

    /**
     * 设置个人资料操作
     *
     * @param UserSettings $request
     * @return $this
     */
    public function doSettings(UserSettings $request)
    {
        $user = Auth::user();

        if ($weixin_qrcode = $this->upload($request, 'weixin_qrcode')) {
            $user->weixin_qrcode = $weixin_qrcode;
        }

        if ($pay_qrcode = $this->upload($request, 'pay_qrcode')) {
            $user->pay_qrcode = $pay_qrcode;
        }

        $user->name     = $request->name;
        $user->gender   = $request->get('gender');
        $user->github   = $request->get('github');
        $user->realname = $request->get('realname');
        $user->city     = $request->get('city');
        $user->company  = $request->get('company');
        $user->position = $request->get('position');
        $user->website  = $request->get('website');
        $user->intro    = $request->get('intro');
        $user->save();

        return back()->with('success', '修改成功!');
    }
}
