<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomPacket extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'packet_id',
        'price',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function packet(): BelongsTo
    {
        return $this->belongsTo(Packet::class);
    }
}
