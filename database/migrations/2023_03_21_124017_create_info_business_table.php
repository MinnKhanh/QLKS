<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_business', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('gmail');
            $table->string('address');
            $table->string('code');
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
        Schema::dropIfExists('info_business');
    }
}
