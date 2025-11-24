<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_tur');
            $table->string('route_retur');
            $table->string('start_place');
            $table->string('end_place');
            $table->time('start_time');
            $table->time('arrival_time');
            $table->decimal('price', 8, 2);
            $table->decimal('price_ron', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }
};
