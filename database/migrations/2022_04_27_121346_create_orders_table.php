<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number', 100)->unique();
            $table->integer('user_id');
            $table->string('ordered_courses')->default('0');
            $table->string('course_type')->nullable()->comment('2=> marathon,3=>Chapter');
            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->decimal('grand_total', 20, 6);
            $table->integer('item_count');
            $table->boolean('payment_status')->default(true);
            $table->string('payment_method')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address')->nullable();
            $table->text('company_name')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('email');
            $table->string('phone_number');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
