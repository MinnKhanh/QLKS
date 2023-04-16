<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_services', function (Blueprint $table) {
            $table->id();
            $table->string('object_id');
            $table->string('type_object');
            $table->string('service_id');
            $table->float('times');
            $table->float('total_price');
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
        Schema::dropIfExists('use_services');
    }
}
