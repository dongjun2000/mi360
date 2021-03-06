<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('logtime')->nullable()->comment('登录时间');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('gender')->default(1)->comment('性别：默认男');
            $table->string('github')->nullable()->comment('github名称');
            $table->char('realname',10)->nullable()->comment('真实姓名');
            $table->char('city', 10)->nullable()->comment('所在城市');
            $table->char('company', 22)->nullable()->comment('公司名称');
            $table->char('position', 22)->nullable()->comment('职位');
            $table->string('website')->nullable()->comment('个人网址');
            $table->string('weixin_qrcode')->nullable()->comment('微信账号二维码');
            $table->string('pay_qrcode')->nullable()->comment('支付二维码');
            $table->string('intro')->nullable()->comment('个人简介');
            $table->unsignedBigInteger('visitor_total')->default(0)->comment('访客总数');
            $table->integer('zan')->default(0)->comment('被赞总数');
            $table->integer('collect')->default(0)->comment('被收藏的总数');
            $table->integer('article')->default(0)->comment('发表的文章总数');
            $table->integer('question')->default(0)->comment('提问的总数');
            $table->integer('answer')->default(0)->comment('回答总数');
            $table->integer('follow')->default(0)->comment('我的关注总数');
            $table->integer('fan')->default(0)->comment('我的粉丝总数');
            $table->integer('message')->default(0)->comment('私信数');
            $table->integer('inform')->default(0)->comment('通知数');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
