<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_videos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('topic_id');
            $table->string('topic_video_title', 255)->nullable();
            $table->string('topic_video_url', 255)->nullable();
            $table->string('topic_video_duration', 255)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('order_id');
            $table->enum('type', ['2'])->default('2');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_videos');
    }
}
