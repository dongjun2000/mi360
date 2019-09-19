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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('articles/hot', 'ArticleController@hotArticle')->name('articles.hot');
Route::get('articles/new', 'ArticleController@newArticle')->name('articles.new');

Route::get('questions/hot', 'QuestionController@hotQuestions')->name('questions.hot');
Route::get('questions/unanswered', 'QuestionController@unanswered')->name('questions.unanswered');

Route::get('tags/{name}/questions', 'TagController@questions')->name('tags.questions');
Route::get('tags/{name}/article', 'TagController@article')->name('tags.article');
Route::get('tags/{name}/info', 'TagController@info')->name('tags.info');

Route::get('comments/{comment}/reply', 'CommentController@reply')->name('comments.reply');


Route::resource('users', 'UserController');
Route::resource('articles', 'ArticleController');
Route::resource('tags', 'TagController');
Route::resource('questions', 'QuestionController');
Route::resource('answers', 'AnswerController');
Route::resource('comments', 'CommentController');
