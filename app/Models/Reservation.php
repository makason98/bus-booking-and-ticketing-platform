<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'start_place',
        'end_place',
        'from',
        'to',
        'phone',
        'email',
        'remarks',
        'date',
        'time',
        'time_arrival',
        'route',
        'price',
        'seats',
        'currency',
        'reservation_number', // Make sure reservation_number is fillable
    ];

    protected static function booted()
    {
        // No need to generate reservation number here
    }

    public static function generateReservationNumber()
    {
        $lastReservation = DB::table('reservations')->orderBy('reservation_number', 'desc')->first();

        $lastNumber = $lastReservation ? $lastReservation->reservation_number : 0;

        return $lastNumber + 1;
    }
    public function busRoute()
    {
        return $this->belongsTo(Route::class, 'reservation_number', 'id');
    }

    public function getFormattedReservationNumberAttribute()
    {
        return str_pad($this->reservation_number, 7, '0', STR_PAD_LEFT);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }
}
