<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log; // Tambahkan import Log facade

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'remaining_capacity',
    ];

    public function packets(): BelongsToMany
    {
        return $this->belongsToMany(Packet::class, 'room_packets')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function roomPackets(): HasMany
    {
        return $this->hasMany(RoomPacket::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function decrementRemainingCapacity(int $decrement, bool $allowNegative = false): void
    {
        $newRemainingCapacity = $allowNegative
            ? $this->remaining_capacity - $decrement
            : max($this->remaining_capacity - $decrement, 0);

        Log::info('Decrementing remaining capacity:', [
            'room_id' => $this->id,
            'current_remaining_capacity' => $this->remaining_capacity,
            'decrement_by' => $decrement,
            'new_remaining_capacity' => $newRemainingCapacity,
        ]);

        $this->update(['remaining_capacity' => $newRemainingCapacity]);
    }

    public function incrementRemainingCapacity(int $increment): void
    {
        $newRemainingCapacity = min($this->remaining_capacity + $increment, $this->capacity);

        Log::info('Incrementing remaining capacity:', [
            'room_id' => $this->id,
            'current_remaining_capacity' => $this->remaining_capacity,
            'increment_by' => $increment,
            'new_remaining_capacity' => $newRemainingCapacity,
        ]);

        $this->update(['remaining_capacity' => $newRemainingCapacity]);
    }

    public function getPacketPrice(Packet $packet): ?float
    {
        $roomPacket = $this->roomPackets->where('packet_id', $packet->id)->first();
        return $roomPacket?->price;
    }

    public function updateRemainingCapacity(int $remaining = null): void
    {
        $this->update([
            'remaining_capacity' => $remaining ?? $this->capacity - $this->bookings()->whereNull('end_time')->count(),
        ]);
    }

    public function syncPackets(array $packetData): void
    {
        Log::info('Syncing packets for room:', [
            'room_id' => $this->id,
            'packet_data' => $packetData
        ]);

        $syncData = collect($packetData)
            ->filter(function ($item) {
                return !empty($item['packet_id']) && !empty($item['price']);
            })
            ->mapWithKeys(function ($item) {
                return [(int)$item['packet_id'] => ['price' => (float)$item['price']]];
            })
            ->toArray();

        Log::info('Prepared sync data:', $syncData);

        $this->packets()->sync($syncData);

        // Refresh the relationship after syncing
        $this->load('packets');

        Log::info('Successfully synced packets');
    }

    public function recalculateRemainingCapacity(): void
    {
        // Hitung jumlah paket aktif langsung dari database
        $totalUsedCapacity = \DB::table('bookings')
            ->join('booking_packets', 'bookings.id', '=', 'booking_packets.booking_id')
            ->where('bookings.room_id', $this->id)
            ->whereIn('bookings.status', ['pending', 'confirmed'])
            ->count();

        $newRemainingCapacity = max($this->capacity - $totalUsedCapacity, 0);

        Log::info('Recalculating room remaining capacity via query:', [
            'room_id' => $this->id,
            'total_capacity' => $this->capacity,
            'total_used_capacity' => $totalUsedCapacity,
            'new_remaining_capacity' => $newRemainingCapacity,
        ]);

        // Update langsung ke database tanpa load model
        $this->update(['remaining_capacity' => $newRemainingCapacity]);
    }

    public function adjustCapacity(int $adjustment): void
    {
        $newRemainingCapacity = max($this->remaining_capacity + $adjustment, 0);

        Log::info('Adjusting room remaining capacity:', [
            'room_id' => $this->id,
            'adjustment' => $adjustment,
            'new_remaining_capacity' => $newRemainingCapacity,
        ]);

        $this->update(['remaining_capacity' => $newRemainingCapacity]);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function (Room $room) {
            if (!$room->remaining_capacity) {
                $room->remaining_capacity = $room->capacity;
            }
        });
    }


}
