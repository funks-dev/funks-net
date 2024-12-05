<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packet extends Model
{
    use HasFactory;

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_packets')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'name',
    ];

    public function roomPackets()
    {
        return $this->hasMany(RoomPacket::class);
    }
}
