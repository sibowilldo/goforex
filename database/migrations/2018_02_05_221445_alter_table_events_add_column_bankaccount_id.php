<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEventsAddColumnBankaccountId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('events', function (Blueprint $table) {
            //
            $table->integer('bank_account_id')->unsigned()->nullable()->default(1)->after('id');

            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('set default');
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
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropForeign(['bank_account_id']);
            $table->dropColumn('bank_account_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}

