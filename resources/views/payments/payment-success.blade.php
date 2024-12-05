<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FunksNet | Payment Success Page</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Animate.css for Animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<x-navbar />

<div class="min-h-screen flex flex-col justify-center items-center py-8 px-4">
    <!-- Top Section with Payment Success! Text and Download Invoice Button -->
    <div class="w-full max-w-3xl flex justify-between items-center mb-8 animate__animated animate__fadeIn">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white w-full text-left">
            Payment Success!
        </h2>
        <button onclick="printInvoice()" class="text-black dark:text-gray-400 w-auto ml-auto hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
        </button>
    </div>

    <div id="invoice-content">
        <!-- Transaction Details -->
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8 animate__animated animate__fadeIn">
            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Transaction ID</div>
                <div class="text-sm text-gray-900 dark:text-white">#{{ str_pad($bookingData['booking_id'], 8, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Transaction Date</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['transaction_date'] }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Status</div>
                <div class="text-sm font-medium {{ $bookingData['status'] === 'Pending' ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400' }}">
                    {{ $bookingData['status'] }}
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8 animate__animated animate__fadeIn">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Room</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['room_name'] }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Package</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['package_name'] }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Start Time</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($bookingData['start_time'])->format('d F Y H:i') }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">End Time</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($bookingData['end_time'])->format('d F Y H:i') }}</div>
            </div>
            <hr class="my-4 border-t-2 border-gray-200 dark:border-gray-600">
            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Total</div>
                <div class="text-sm text-gray-900 dark:text-white font-semibold">Rp {{ number_format($bookingData['total_payment'], 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Customer & Payment Info -->
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8 animate__animated animate__fadeIn">
            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Customer Name</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['customer_name'] }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Customer Email</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['customer_email'] }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">Payment Method</div>
                <div class="text-sm text-gray-900 dark:text-white">{{ $bookingData['payment_method'] }}</div>
            </div>
        </div>
    </div>

    <!-- Back to Landing Button -->
    <div class="w-full max-w-3xl text-center">
        <a href="{{ route('landing') }}" class="inline-block w-full px-6 py-2 bg-black text-white rounded-md hover:bg-gray-700 transition duration-300 transform hover:scale-105">
            Back to Landing
        </a>
    </div>
</div>

<x-footer />

<!-- Flowbite JS -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>

<script>
    function printInvoice() {
        // Get the invoice content
        const invoiceContent = document.getElementById('invoice-content').innerHTML;

        // Create a new window for printing
        const printWindow = window.open('', '', 'height=800,width=800');

        // Add necessary styles
        printWindow.document.write(`
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
            <head>
                <title>Booking Invoice</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
                    .mb-8 { margin-bottom: 2rem; }
                    .p-6 { padding: 1.5rem; }
                    .bg-white { background-color: white; }
                    .rounded-lg { border-radius: 0.5rem; }
                    .shadow-lg { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
                    .text-sm { font-size: 0.875rem; }
                    .font-semibold { font-weight: 600; }
                    hr { margin: 1rem 0; border: 1px solid #eee; }
                    @media print {
                        .bg-white { background-color: white !important; }
                        .shadow-lg { box-shadow: none !important; }
                    }
                </style>
            </head>
            <body>
                ${invoiceContent}
            </body>
        </html>
    `);

        printWindow.document.close();

        // Wait for the window to load before printing
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 250);
    }
</script>

</body>
</html>
