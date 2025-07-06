<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_youtube_videos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('course_id');
    $table->string('youtube_url');
    $table->timestamps();

    $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_youtube_videos');
    }
};
