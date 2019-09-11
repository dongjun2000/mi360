<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->comment('文章类型,原创、转载、翻译');
            $table->integer('user_id');
            $table->string('title');
            $table->string('pic')->default('');
            $table->string('intro');
            $table->text('content');
            $table->integer('read')->default(0);
            $table->integer('zan')->default(0);
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
        Schema::dropIfExists('articles');
    }
}
