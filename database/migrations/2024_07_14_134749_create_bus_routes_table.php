<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusRoutesTable extends Migration
{
    public function up()
    {
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('direction');
            for ($i = 1; $i <= 20; $i++) {
                $table->boolean('seat_' . $i)->default(false);
            }
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bus_routes');
    }
}

