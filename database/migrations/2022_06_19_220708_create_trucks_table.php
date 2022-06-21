<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->unsignedTinyInteger('seats');
            $table->unsignedInteger('bed_length');
            $table->string('color');
            $table->string('vin');
            $table->unsignedInteger('mileage');
            $table->unsignedInteger('service_int');
            $table->unsignedInteger('next_service');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trucks');
    }
}
