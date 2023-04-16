<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionOfProductRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition_of_product_room', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_room_id');
            $table->bigInteger('quantity');
            $table->integer('status');
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
        Schema::dropIfExists('condition_of_product_room');
    }
}
