<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'direction',
        // Add seat fields dynamically
        'seat_1', 'seat_2', 'seat_3', 'seat_4', 'seat_5',
        'seat_6', 'seat_7', 'seat_8', 'seat_9', 'seat_10',
        'seat_11', 'seat_12', 'seat_13', 'seat_14', 'seat_15',
        'seat_16', 'seat_17', 'seat_18', 'seat_19', 'seat_20',
    ];
}
