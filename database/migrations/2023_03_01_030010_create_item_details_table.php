<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('live_id');
            $table->foreign('live_id')->references('id')->on('lives')->onDelete('cascade');
            $table->unsignedInteger('process_id');
            $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
            $table->string('miner_username');
            $table->integer('price');
            $table->integer('size');
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
        Schema::dropIfExists('item_details');
    }
}
