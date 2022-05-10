<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone_title', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('address_title', 255)->nullable();
            $table->string('address_details', 255)->nullable();
            $table->string('email_title', 255)->nullable();
            $table->string('email_details', 255)->nullable();
            $table->string('social_title', 255)->nullable();
            $table->text('social_instagram')->nullable();
            $table->text('social_youtube')->nullable();
            $table->text('social_facebook')->nullable();
            $table->string('que_ans_title', 255)->nullable();
            $table->text('que_ans_desc')->nullable();
            $table->integer('phonenumber1');
            $table->integer('phonenumber2');
            $table->string('address1');
            $table->string('address2');
            $table->string('youtube_link');
            $table->string('insta_link');
            $table->string('facebook_link');
            $table->decimal('longitude1', 10, 7);
            $table->decimal('lattitude1', 10, 7);
            $table->decimal('longitude2', 10, 7);
            $table->decimal('lattitude2', 10, 7);
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
        Schema::dropIfExists('contactuses');
    }
}
