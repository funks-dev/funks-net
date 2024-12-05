<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

class Booking extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function packets(): BelongsToMany
    {
        return $this->belongsToMany(Packet::class, 'booking_packets')
            ->withTimestamps();
    }

    protected $fillable = [
        'user_id',
        'room_id',
        'packet_ids',
        'start_time',
        'end_time',
        'total_payment',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'packet_ids' => 'array',
        'total_payment' => 'decimal:2',
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];

    public function getFormattedStartTimeAttribute(): string
    {
        return $this->start_time->format('d M Y H:i');
    }

    public function getFormattedTotalPaymentAttribute(): string
    {
        return 'Rp ' . number_format($this->total_payment, 2);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }

    public function saveWithPackets(array $data): Booking
    {
        Log::info('Saving booking with packets:', $data);

        // Create the booking
        $booking = $this->create($data);

        // Sync packets
        if (!empty($data['packet_ids']) && is_array($data['packet_ids'])) {
            Log::info('Syncing packets for booking:', [
                'booking_id' => $booking->id,
                'packet_ids' => $data['packet_ids'],
            ]);

            $booking->packets()->sync($data['packet_ids']);
            Log::info('Sync result:', ['attached' => $data['packet_ids']]);
        }

        // Refresh relationships for accurate calculations
        $booking->load('packets', 'room');

        // Trigger capacity update after syncing packets
        if ($booking->room) {
            $booking->room->recalculateRemainingCapacity();
        }

        return $booking;
    }

    public function getPacketsAttribute()
    {
        return $this->packets()->get()->map(function ($packet) {
            return $packet->name . ' (Rp ' . number_format($this->room->getPacketPrice($packet), 2) . ')';
        })->implode(', ');
    }

    protected static function boot()
    {
        parent::boot();

        // Ketika booking baru dibuat
        static::created(function (Booking $booking) {
            if ($booking->status === 'pending') {
                $booking->room->decrementRemainingCapacity();
            }
        });

        // Ketika status booking berubah
        static::updated(function (Booking $booking) {
            if ($booking->isDirty('status')) {
                $oldStatus = $booking->getOriginal('status');
                $newStatus = $booking->status;

                // Jika status berubah menjadi pending/confirmed
                if (in_array($newStatus, ['pending', 'confirmed']) && !in_array($oldStatus, ['pending', 'confirmed'])) {
                    $booking->room->decrementRemainingCapacity();
                }
                // Jika status berubah dari pending/confirmed ke status lain
                elseif (!in_array($newStatus, ['pending', 'confirmed']) && in_array($oldStatus, ['pending', 'confirmed'])) {
                    $booking->room->incrementRemainingCapacity();
                }
            }
        });

        // Ketika booking dihapus
        static::deleted(function (Booking $booking) {
            if (in_array($booking->status, ['pending', 'confirmed'])) {
                $booking->room->incrementRemainingCapacity();
            }
        });
    }
}
