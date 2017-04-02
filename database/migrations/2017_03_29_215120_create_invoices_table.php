<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_is');
            $table->integer('user_id')->unsigned();
            $table->decimal('amount',13,2);
            $table->decimal('discount',13,2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('invoice_item', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('price',13,2);

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->primary(['invoice_id','item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_item');
        Schema::drop('invoices');
    }
}
