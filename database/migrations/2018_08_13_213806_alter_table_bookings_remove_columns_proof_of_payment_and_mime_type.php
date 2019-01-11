<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBookingsRemoveColumnsProofOfPaymentAndMimeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
            $table->dropColumn(['mime_type']);
            $table->dropColumn(['proof_of_payment']);
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
            $table->binary('proof_of_payment')->nullable()->after('event_id');
            $table->string('mime_type')->nullable()->after('proof_of_payment');
        });
    }
}
