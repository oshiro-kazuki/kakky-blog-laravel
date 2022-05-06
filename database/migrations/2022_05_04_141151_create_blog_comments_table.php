<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('blog_id', 20);
            $table->tinyInteger('user_type')->default(0);
            $table->string('ip', 15)->nullable();
            $table->tinyInteger('view_flg')->default(0);
            $table->tinyInteger('del_flg')->default(0);
            $table->string('comment_id', 20)->nullable();
            $table->string('name', 20)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('comment', 140);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
