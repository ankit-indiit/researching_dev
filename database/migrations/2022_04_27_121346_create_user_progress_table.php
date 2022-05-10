<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('topic_id');
            $table->string('video_ids', 255)->nullable();
            $table->string('pdf_ids', 255)->nullable();
            $table->enum('status', ['0', '1'])->default('0')->comment('0=>No repeat view, 1=>repeat again element');
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
        Schema::dropIfExists('user_progress');
    }
}
