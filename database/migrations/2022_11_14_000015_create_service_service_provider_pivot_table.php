<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceServiceProviderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('service_service_provider', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_7619227')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('service_provider_id');
            $table->foreign('service_provider_id', 'service_provider_id_fk_7619227')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }
}
