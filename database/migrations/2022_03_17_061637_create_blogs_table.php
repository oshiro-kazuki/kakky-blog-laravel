<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title', 20);
            $table->boolean('image_flg')->default(false);
            $table->tinyInteger('category');
            $table->string('origin_title', 20);
            $table->string('origin_text', 1000);
            $table->boolean('origin_img_flg')->default(false);
            $table->string('accepted_title', 20);
            $table->string('accepted_text', 1000);
            $table->boolean('accepted_img_flg')->default(false);
            $table->string('but_title', 20);
            $table->string('but_text', 1000);
            $table->boolean('but_img_flg')->default(false);
            $table->string('conclusion_title', 20);
            $table->string('conclusion_text', 1000);
            $table->boolean('conclusion_img_flg')->default(false);
            $table->smallInteger('nice')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
