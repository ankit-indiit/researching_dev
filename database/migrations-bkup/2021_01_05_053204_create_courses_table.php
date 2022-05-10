<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_name');
            $table->string('description',700);
            $table->decimal('price');
            $table->string('degree_id');
            $table->string('university_id');
            $table->string('course_type');
            $table->string('instructor_id');
            $table->string('video_link');
            $table->string('type')->default(0);
            $table->string('event_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('topics',1000)->nullable();
            $table->string('start_date')->nullable();
            $table->string('zoom_link')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('image')->default('1.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
