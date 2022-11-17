<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToServiceProviderSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('service_provider_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->foreign('service_provider_id', 'service_provider_fk_7620402')->references('id')->on('service_providers');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7620405')->references('id')->on('teams');
        });
    }
}