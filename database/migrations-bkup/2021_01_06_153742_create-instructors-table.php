<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->integer('instructor_course_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email',100)->unique();
            $table->string('contact_number');
            $table->string('avatar')->default('1.jpg');
            $table->string('about');
            $table->string('address');
            $table->string('destiny');
            $table->string('university');
            $table->string('degree');
            $table->string('qualification');
            $table->string('insta_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('whatspp_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('recommendations')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
