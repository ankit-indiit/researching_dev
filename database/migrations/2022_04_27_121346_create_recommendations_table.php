<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instructor_id')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('user_id');
            $table->text('description');
            $table->string('recommed_tag_line', 255)->nullable();
            $table->string('course_id')->nullable();
            $table->string('is_approved')->default('0');
            $table->string('type')->nullable();
            $table->string('website')->nullable();
            $table->string('is_posted')->default('0');
            $table->string('status')->default('0');
            $table->string('user_image')->default('default.jpg');
            $table->string('course_user_social_link', 255)->nullable();
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
        Schema::dropIfExists('recommendations');
    }
}
