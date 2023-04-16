<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_room_id');
            $table->integer('room_capacity_id');
            $table->integer('price');
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
        Schema::dropIfExists('room_type_detail');
    }
}
