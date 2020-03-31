<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            // 主キー
            $table->increments('id');
            // タイトル
            $table->string('title', 200);
            // 本文
            $table->text('content');
            // created_at・updated_at
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
        Schema::dropIfExists('posts');
    }
}