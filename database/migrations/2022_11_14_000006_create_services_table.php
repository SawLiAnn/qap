<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->string('service_description')->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->integer('duration');
            $table->timestamps();
        });
    }
}