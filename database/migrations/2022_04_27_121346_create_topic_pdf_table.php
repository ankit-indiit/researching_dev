<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicPdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_pdf', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('topic_id');
            $table->string('topic_pdf_title', 255)->nullable();
            $table->string('topic_pdf_url', 255)->nullable();
            $table->integer('order_id');
            $table->enum('type', ['1'])->default('1');
            $table->enum('status', ['0', '1'])->default('0');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_pdf');
    }
}
