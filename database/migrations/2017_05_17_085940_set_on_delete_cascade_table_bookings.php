<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetOnDeleteCascadeTableBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['event_id']);

            $table->foreign('event_id')
            ->references('id')->on('events')
            ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['event_id']);

            $table->foreign('event_id')
            ->references('id')->on('events');
        });

        Schema::enableForeignKeyConstraints();
    }
}
