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
            $table->id();
            $table->Integer('phonenumber1');
            $table->Integer('phonenumber2');
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
