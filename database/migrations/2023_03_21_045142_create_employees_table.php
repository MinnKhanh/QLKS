<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('position_id');
            $table->bigInteger('account_id');
            $table->string('cmtnd');
            $table->string('phone');
            $table->string('email');
            $table->bigInteger('gender');
            $table->date('birth_day');
            $table->string('bank_number');
            $table->string('bank_name');
            $table->string('home_town');
            $table->date('date_entered');
            $table->text('description');
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
        Schema::dropIfExists('employees');
    }
}
