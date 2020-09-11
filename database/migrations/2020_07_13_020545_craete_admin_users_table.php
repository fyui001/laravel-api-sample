<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('id');
            $table->string('login_id')->unique('UNQ_ADMIN_LOGIN_ID')->comment('ログインID');
            $table->string('password')->comment('パスワード');
            $table->string('name')->comment('名前');
            $table->boolean('role')->default(0)->comment('ロール');
            $table->boolean('status')->default(1)->comment('ステータス');
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
        Schema::dropIfExists('admin_users');
    }
}
