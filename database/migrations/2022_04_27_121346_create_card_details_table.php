<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 255);
            $table->string('card_number', 255);
            $table->string('card_type', 255);
            $table->string('customer_id', 255);
            $table->string('is_default', 255)->default('0');
            $table->string('stripe_card_id', 255);
            $table->string('card_holder_name', 255);
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
        Schema::dropIfExists('card_details');
    }
}
