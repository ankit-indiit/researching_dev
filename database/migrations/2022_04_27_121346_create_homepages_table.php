<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('banner_text')->nullable();
            $table->text('banner_image')->nullable();
            $table->text('banner_background')->nullable();
            $table->string('banner_mobile_image', 255)->nullable();
            $table->string('banner_facebook', 255)->nullable();
            $table->string('banner_insta', 255)->nullable();
            $table->string('banner_whatsapp', 255)->nullable();
            $table->string('service_title', 255)->nullable();
            $table->text('service_desc')->nullable();
            $table->string('course_title', 255)->nullable();
            $table->text('course_description')->nullable();
            $table->longText('banner_list')->nullable();
            $table->longText('success')->nullable();
            $table->boolean('funfactor')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepages');
    }
}
