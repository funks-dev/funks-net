<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    public function saved(Booking $booking): void
    {
        $room = $booking->room;
        if ($room) {
            $packetCount = $booking->packets()->count();
            $adjustment = ($booking->wasRecentlyCreated ? -$packetCount : 0);

            Log::info('Adjusting capacity on booking save:', [
                'booking_id' => $booking->id,
                'adjustment' => $adjustment,
            ]);

            $room->adjustCapacity($adjustment);
        }
    }

    public function deleted(Booking $booking): void
    {
        $room = $booking->room;
        if ($room) {
            $packetCount = $booking->packets()->count();

            Log::info('Adjusting capacity on booking delete:', [
                'booking_id' => $booking->id,
                'adjustment' => $packetCount,
            ]);

            $room->adjustCapacity($packetCount);
        }
    }

    private function updateRoomRemainingCapacity(Booking $booking): void
    {
        $room = $booking->room;

        if (!$room) {
            Log::warning('Room not found for booking:', ['booking_id' => $booking->id]);
            return;
        }

        // Refresh packets to ensure accurate relationship
        $booking->load('packets');
        $room->load('bookings.packets');

        // Calculate total used capacity from all active bookings
        $activeBookings = $room->bookings()->whereIn('status', ['pending', 'confirmed'])->get();

        $totalUsedCapacity = $activeBookings->sum(function ($activeBooking) {
            return $activeBooking->packets()->count();
        });

        $newRemainingCapacity = $room->capacity - $totalUsedCapacity;

        Log::info('Updating room remaining capacity:', [
            'room_id' => $room->id,
            'total_capacity' => $room->capacity,
            'total_used_capacity' => $totalUsedCapacity,
            'new_remaining_capacity' => $newRemainingCapacity,
        ]);

        $room->update(['remaining_capacity' => max($newRemainingCapacity, 0)]);
    }
}
