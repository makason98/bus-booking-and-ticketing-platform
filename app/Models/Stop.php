<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id', 'route_stop', 'stop_time', 'price', 'price_ron','pickup'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
