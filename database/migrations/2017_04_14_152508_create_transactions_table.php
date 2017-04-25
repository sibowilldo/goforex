<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Extra 1 = user_id; Extra 2 = booking_id; Extra 3 = event_id;
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('transactionAccepted');
            $table->string('cardHolderIpAddr');
            $table->string('requestTrace');
            $table->string('reference');
            $table->integer('extra1')->unsigned()->comment('user id'); //Extra Field 1
            $table->integer('extra2')->unsigned()->comment('booking id'); //Extra Field 2
            $table->integer('extra3')->unsigned()->comment('event id'); // Extra Field 3
            $table->double('amount');
            $table->string('m10')->nullable(); //m10 extra field, appended to the end of accept page
            $table->integer('method')->nullable(); // 2 for EFT, 3 for Retail
            $table->string('reason')->nullable();
            $table->timestamps();

            //Foreign Keys
            $table->foreign('extra1')->references('id')->on('users');
            $table->foreign('extra2')->references('id')->on('bookings');
            $table->foreign('extra3')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
