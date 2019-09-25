<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

// 首页热门
Route::get('hottest/{time?}', 'HomeController@hottest')->name('hottest');
// 首页最新
Route::get('newest', 'HomeController@newest')->name('newest');
// 技术频道
Route::get('channel/{channel?}', 'HomeController@channel')->name('channel');

// 关注与取关
Route::get('follow/{user}', 'UserController@follow')->name('users.follow');

Route::get('users/{user}/follows', 'FollowController@follows')->name('users.follows');
Route::get('users/{user}/fans', 'FollowController@fans')->name('users.fans');
Route::get('users/{user}/articles', 'UserController@articles')->name('users.articles');
Route::get('users/{user}/questions', 'UserController@questions')->name('users.questions');
Route::get('users/{user}/answers', 'UserController@answers')->name('users.answers');
Route::get('users/{user}/collects', 'UserController@collects')->name('users.collects');

// 个人设置
Route::get( 'users/settings', 'UserController@settings')->name('users.settings');
Route::post('users/settings', 'UserController@doSettings')->name('users.settings');

Route::get('articles/hot', 'ArticleController@hotArticle')->name('articles.hot');
Route::get('articles/new', 'ArticleController@newArticle')->name('articles.new');

Route::get('questions/hot', 'QuestionController@hotQuestions')->name('questions.hot');
Route::get('questions/unanswered', 'QuestionController@unanswered')->name('questions.unanswered');

Route::get('tags/{name}/questions', 'TagController@questions')->name('tags.questions');
Route::get('tags/{name}/article', 'TagController@article')->name('tags.article');
Route::get('tags/{name}/info', 'TagController@info')->name('tags.info');

Route::resource('users', 'UserController');
Route::resource('articles', 'ArticleController');
Route::resource('tags', 'TagController');
Route::resource('questions', 'QuestionController');
Route::resource('answers', 'AnswerController');
Route::resource('comments', 'CommentController');
Route::resource('categories', 'CategoryController');

