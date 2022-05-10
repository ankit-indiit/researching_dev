<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_quiz_questions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('quiz_id');
            $table->integer('topic_id');
            $table->string('question', 255);
            $table->string('optionA', 255);
            $table->string('optionB', 255);
            $table->string('optionC', 255);
            $table->string('optionD', 255);
            $table->string('answer', 255);
            $table->string('questionImage', 255)->nullable();
            $table->string('questionLink', 255)->nullable();
            $table->enum('questionType', ['1', '2'])->default('1')->comment('1=>text,2=>image');
            $table->enum('type', ['3'])->default('3');
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
        Schema::dropIfExists('topic_quiz_questions');
    }
}
