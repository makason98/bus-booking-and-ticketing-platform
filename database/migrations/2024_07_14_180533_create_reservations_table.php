<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('start_place');
            $table->string('end_place');
            $table->string('from');
            $table->string('to');
            $table->string('phone');
            $table->string('email');
            $table->text('remarks')->nullable();
            $table->date('date');
            $table->time('time');
            $table->time('time_arrival');
            $table->string('route');
            $table->string('seats');
            $table->string('currency');
            $table->unsignedBigInteger('reservation_number'); // Unique but not auto-increment
            $table->decimal('price', 8, 2); // Add price column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
