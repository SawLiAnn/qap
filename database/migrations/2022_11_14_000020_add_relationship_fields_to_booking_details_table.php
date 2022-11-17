<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id', 'service_fk_7618961')->references('id')->on('services');
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->foreign('service_provider_id', 'service_provider_fk_7618962')->references('id')->on('service_providers');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_7618997')->references('id')->on('clients');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7618968')->references('id')->on('teams');
        });
    }
}