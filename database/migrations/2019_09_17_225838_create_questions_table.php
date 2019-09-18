<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')->default(0)->comment('状态');
            $table->integer('user_id');
            $table->string('title');
            $table->text('content');
            $table->integer('follow')->default(0)->comment('关注数');
            $table->integer('answer')->default(0)->comment('回答数');
            $table->integer('read')->default(0)->comment('浏览数');
            $table->json('laster_answer_user')->comment('最新回答人');
            $table->boolean('hot')->default(false)->comment('是否热门');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
