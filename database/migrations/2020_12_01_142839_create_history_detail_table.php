<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_detail', function (Blueprint $table) {
            $table->unsignedInteger('history_id');
            $table->foreign('history_id')->references('id')->on('histories');
            $table->unsignedInteger('flower_id');
            $table->foreign('flower_id')->references('id')->on('flowers');
            $table->integer('quantity');
            $table->integer('subtotal');
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
        Schema::dropIfExists('history_detail');
    }
}
