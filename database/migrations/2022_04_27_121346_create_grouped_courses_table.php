<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouped_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('groupName');
            $table->string('whatsappLink')->nullable();
            $table->string('courseIds')->nullable();
            $table->string('price')->nullable();
            $table->string('type')->default('1');
            $table->string('group_code')->nullable();
            $table->string('link_selected')->default('0');
            $table->string('event_id')->nullable();
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
        Schema::dropIfExists('grouped_courses');
    }
}
