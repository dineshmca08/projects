<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_video_likes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('videos_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('user_video_likes', function (Blueprint $table) {
            $table->foreign('videos_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_video_likes', function (Blueprint $table) {
            $table->dropForeign(['videos_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_video_likes');
    }
}
