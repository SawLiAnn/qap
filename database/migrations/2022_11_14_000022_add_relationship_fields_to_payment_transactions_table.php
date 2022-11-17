<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_details_id')->nullable();
            $table->foreign('booking_details_id', 'booking_details_fk_7619121')->references('id')->on('booking_details');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_7619122')->references('id')->on('clients');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7619128')->references('id')->on('teams');
        });
    }
}