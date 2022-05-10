<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastWatchElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_watch_element', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('course_id');
            $table->integer('topic_id');
            $table->integer('user_id');
            $table->enum('element_type', ['1', '2', '3'])->comment('1=>pdf,2=>video,3=>quiz');
            $table->integer('element_id');
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
        Schema::dropIfExists('last_watch_element');
    }
}
