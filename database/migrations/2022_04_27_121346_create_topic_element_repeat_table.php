<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicElementRepeatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_element_repeat', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('topic_id');
            $table->integer('element_id');
            $table->enum('element_type', ['1', '2', '3'])->comment('1=>pdf,2=>video,3=>quiz');
            $table->enum('is_repeat', ['0', '1'])->default('1');
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
        Schema::dropIfExists('topic_element_repeat');
    }
}
