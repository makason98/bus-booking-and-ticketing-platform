<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_tur', 'route_retur', 'start_time', 'arrival_time', 'price', 'price_ron', 'start_place', 'end_place'
    ];

    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}
