<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentSuccessController extends Controller
{
    public function show()
    {
        if (!session()->has('booking_data')) {
            return redirect()->route('landing');
        }

        $bookingData = session('booking_data');
        return view('payments.payment-success', compact('bookingData'));
    }
}
