<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couponcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_name');
            $table->string('coupon_code');
            $table->string('type')->default('percentage(%)');
            $table->integer('value');
            $table->integer('coupon_type')->comment('0 for whole website and 1 for institution based.');
            $table->string('university_name')->nullable();
            $table->string('course_name')->nullable();
            $table->string('degree_name')->nullable();
            $table->date('started_at');
            $table->date('expired_at');
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
        Schema::dropIfExists('couponcodes');
    }
}
