<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('service_provider_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }
}