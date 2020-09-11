<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id')->comment('id');
            $table->string('user_id')->uniqid('UNQ_USER_LOGIN_ID')->comment('ユーザーID');
            $table->string('password')->comment('パスワード');
            $table->string('access_token')->comment('アクセストークン');
            $table->string('name')->comment('名前');
            $table->string('del_flg')->comment('削除フラグ');
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
