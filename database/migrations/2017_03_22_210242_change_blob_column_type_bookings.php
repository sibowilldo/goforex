<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBlobColumnTypeBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //ALTER TABLE bookings MODIFY COLUMN  proof_of_payment MEDIUMBLOB
            DB::statement('ALTER TABLE `bookings` CHANGE `proof_of_payment` `proof_of_payment` MEDIUMBLOB NULL DEFAULT NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
            //ALTER TABLE bookings MODIFY COLUMN  proof_of_payment MEDIUMBLOB
            DB::statement('ALTER TABLE `bookings` CHANGE `proof_of_payment` `proof_of_payment` BLOB NULL DEFAULT NULL');
        });
    }
}
