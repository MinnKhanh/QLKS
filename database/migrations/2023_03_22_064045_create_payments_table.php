<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bill_id');
            $table->bigInteger('creator_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('booking_id');
            $table->bigInteger('amount')->nullable();
            $table->string('phone');
            $table->string('cmtnd');
            $table->integer('payment_method');
            $table->string('note');
            $table->float('price', 10);
            $table->float('satus')->default(0);
            $table->float('discount')->default(0);
            $table->float('late_checkin_fee');
            $table->float('early_checkIn_fee');
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
        Schema::dropIfExists('payments');
    }
}
