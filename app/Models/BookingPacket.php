<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingPacket extends Model
{
    protected $fillable = [
        'booking_id',
        'packet_id',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function packet(): BelongsTo
    {
        return $this->belongsTo(Packet::class);
    }
}
