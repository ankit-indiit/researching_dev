<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 255);
            $table->string('course_id', 255);
            $table->string('topic_id', 255)->nullable();
            $table->string('name', 255);
            $table->string('description', 1000);
            $table->string('quantity', 255);
            $table->string('price', 255);
            $table->string('image', 255);
            $table->string('item_type', 255)->comment('0=>course,1=>package,3=>topic(capter)');
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
        Schema::dropIfExists('cart_items');
    }
}
