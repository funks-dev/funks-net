<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Packet;
use App\Models\RoomPacket;
use App\Models\Booking;
use App\Models\PaymentMethod;
use App\Models\FoodDrink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $packets = Packet::all();
        $roomPackets = RoomPacket::all();
        $foodDrinks = FoodDrink::all();

        return view('landing', compact('rooms', 'packets', 'roomPackets', 'foodDrinks'));
    }

    public function showPaymentConfirmationForm()
    {
        $paymentMethods = PaymentMethod::where('is_active', true)->get();
        return view('payments.payment-confirmation', compact('paymentMethods'));
    }

    public function processPayment(Request $request)
    {
        Log::info('Payment process started', $request->all());

        try {
            // Validate input
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'order_date' => 'required|date',
                'end_time' => 'required|date|after:order_date',
                'payment_method' => 'required|exists:payment_methods,code',
                'room_name' => 'required|string',
                'package_name' => 'required|string',
                'price' => 'required|numeric'
            ]);

            // Get room data
            $room = Room::where('name', $request->room_name)->firstOrFail();

            // Get packet data
            $packetName = explode(' - ', $request->package_name)[0];
            $packet = Packet::where('name', 'LIKE', "%{$packetName}%")->firstOrFail();

            // Check room availability
            $isRoomAvailable = $this->checkRoomAvailability(
                $room->id,
                $request->order_date,
                $request->end_time
            );

            if (!$isRoomAvailable) {
                return back()->withErrors([
                    'error' => 'Room tidak tersedia untuk waktu yang dipilih.'
                ])->withInput();
            }

            DB::beginTransaction();

            try {
                // Create booking
                $booking = new Booking();
                $booking->user_id = auth()->id() ?? null;
                $booking->room_id = $room->id;
                $booking->packet_ids = json_encode([$packet->id]);
                $booking->start_time = Carbon::parse($request->order_date);
                $booking->end_time = Carbon::parse($request->end_time);
                $booking->total_payment = $request->price;
                $booking->payment_method = $request->payment_method;
                $booking->status = 'pending';
                $booking->save();

                // Prepare success data
                $successData = [
                    'booking_id' => $booking->id,
                    'transaction_date' => now()->format('d F Y H:i'),
                    'room_name' => $request->room_name,
                    'package_name' => $packetName,
                    'total_payment' => $request->price,
                    'payment_method' => PaymentMethod::where('code', $request->payment_method)->first()->name,
                    'start_time' => $request->order_date,
                    'end_time' => $request->end_time,
                    'customer_name' => $request->full_name,
                    'customer_email' => $request->email,
                    'status' => 'Pending'
                ];

                DB::commit();

                return redirect()
                    ->route('payment-success')
                    ->with('booking_data', $successData);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Database transaction failed:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Error processing payment:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.'])
                ->withInput();
        }
    }

    private function checkRoomAvailability($roomId, $startTime, $endTime)
    {
        $conflictingBookings = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->where('status', '!=', 'cancelled')
            ->count();

        return $conflictingBookings === 0;
    }
}
