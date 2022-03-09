<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_id', 32)->unique();
            $table->timestamps();
            $table->string('name', 140);
            $table->string('address', 191);
            $table->string('tel', 11);
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60);
            $table->string('profile', 140)->nullable();
            $table->boolean('profile_image_flg')->default(false);
            $table->boolean('Withdrawal')->default(false);
            $table->timestamp('Withdrawal_date')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
