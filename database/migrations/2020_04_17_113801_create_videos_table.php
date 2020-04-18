<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('category_type')->default(0);
            $table->date('expiry_date')->nullable();
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->unsignedInteger('like_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('category_type')->references('id')->on('video_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['category_type']);
        });
        Schema::dropIfExists('videos');
    }
}
