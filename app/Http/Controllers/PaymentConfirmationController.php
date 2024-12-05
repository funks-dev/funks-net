<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Packet;
use App\Models\Booking;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentConfirmationController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Log::info('Payment request received:', $request->all());

            // Convert dates to Carbon instances for comparison
            $orderDate = Carbon::parse($request->order_date);
            $endTime = Carbon::parse($request->end_time);

            // Custom validation for dates
            if ($endTime->lessThanOrEqualTo($orderDate)) {
                throw new \Exception('End time must be after start time');
            }

            // Validate other fields
            $validated = $request->validate([
                'room_name' => 'required|string',
                'package_name' => 'required|string',
                'price' => 'required|numeric',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'order_date' => 'required|date',
                'end_time' => 'required|date',
                'payment_method' => 'required|exists:payment_methods,code',
                'booking_info' => 'required|json'
            ]);

            // Get room
            $room = Room::where('name', $request->room_name)->first();
            if (!$room) {
                throw new \Exception('Room not found');
            }

            // Get packet
            $packetName = explode(' - ', $request->package_name)[0];
            $packet = Packet::where('name', 'LIKE', "%{$packetName}%")->first();
            if (!$packet) {
                throw new \Exception('Package not found');
            }

            // Check room availability
            $isAvailable = !Booking::where('room_id', $room->id)
                ->where(function($query) use ($orderDate, $endTime) {
                    $query->where(function($q) use ($orderDate, $endTime) {
                        $q->where('start_time', '<=', $orderDate)
                            ->where('end_time', '>=', $orderDate);
                    })->orWhere(function($q) use ($orderDate, $endTime) {
                        $q->where('start_time', '<=', $endTime)
                            ->where('end_time', '>=', $endTime);
                    })->orWhere(function($q) use ($orderDate, $endTime) {
                        $q->where('start_time', '>=', $orderDate)
                            ->where('end_time', '<=', $endTime);
                    });
                })
                ->whereNotIn('status', ['cancelled'])
                ->exists();

            if (!$isAvailable) {
                throw new \Exception('Room not available for selected time');
            }

            // Create booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'room_id' => $room->id,
                'packet_ids' => json_encode([$packet->id]),
                'start_time' => $orderDate,
                'end_time' => $endTime,
                'total_payment' => $request->price,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);

            // Sync packet
            $booking->packets()->sync([$packet->id]);

            // Update room capacity
            $room->updateRemainingCapacity();

            $successData = [
                'booking_id' => $booking->id,
                'transaction_date' => now()->format('d F Y H:i'),
                'room_name' => $request->room_name,
                'package_name' => $packetName,
                'total_payment' => $request->price,
                'payment_method' => PaymentMethod::where('code', $request->payment_method)->first()->name,
                'start_time' => $orderDate,
                'end_time' => $endTime,
                'customer_name' => $request->full_name,
                'customer_email' => $request->email,
                'status' => 'Pending'
            ];

            DB::commit();

            Log::info('Booking created successfully:', ['booking_id' => $booking->id]);

            return redirect()
                ->route('payment.success')
                ->with('booking_data', $successData);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Payment processing error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
}
