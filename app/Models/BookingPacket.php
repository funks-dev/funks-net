<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPacket extends Model
{
    protected $fillable = [
        'booking_id',
        'packet_id',
    ];
}
