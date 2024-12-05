<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FunksNet | Payment Confirmation Page</title>
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

<div class="min-h-screen flex flex-col justify-center items-center py-8">
    <!-- New Section for Item Details -->
    <div class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg transform transition-transform duration-300 animate__animated animate__fadeIn mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Booking Information</h3>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">Item Purchased</div>
            <div class="text-sm text-gray-900 dark:text-white" id="room-name"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">Package</div>
            <div id="package-name" class="text-sm text-gray-900 dark:text-white"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">Price</div>
            <div id="price" class="text-sm text-gray-900 dark:text-white"></div>
        </div>
    </div>

    <!-- Payment Confirmation Form -->
    <div class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg transform transition-transform duration-300 animate__animated animate__fadeIn">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-white">Payment Confirmation</h2>

        <!-- In your payment-confirmation.blade.php -->
        <form action="{{ route('payment-confirmation.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Display validation errors if any -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Hidden inputs for room and package data -->
            <input type="hidden" name="room_name" id="form-room-name">
            <input type="hidden" name="package_name" id="form-package-name">
            <input type="hidden" name="price" id="form-price">

            <!-- Full Name -->
            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                <input type="text"
                       id="full_name"
                       name="full_name"
                       value="{{ auth()->check() ? auth()->user()->name : old('full_name') }}"
                       class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                       required />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                       class="mt-1 block w-full px-4 py-2 border rounded-md {{ auth()->check() ? 'bg-gray-100 dark:bg-gray-600' : 'dark:bg-gray-700' }} dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                       {{ auth()->check() ? 'readonly' : '' }}
                       required />
            </div>

            <!-- Order Date and End Time -->
            <div class="flex mb-4 justify-between gap-4">
                <div class="w-1/2">
                    <label for="order_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Booking Time</label>
                    <input type="datetime-local"
                           id="order_date"
                           name="order_date"
                           class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                           required />
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Booking Time</label>
                    <div id="end-time-display" class="mt-1 block w-full px-4 py-2 border rounded-md bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300">
                        -
                    </div>
                    <input type="hidden" id="end_time" name="end_time">
                </div>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                <select id="payment_method"
                        name="payment_method"
                        class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                        required>
                    <option value="">Select Payment Method</option>
                    @foreach($paymentMethods as $method)
                        <option value="{{ $method->code }}">{{ $method->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Payment -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Payment</p>
                <p id="total-payment" class="text-sm font-medium text-green-900 dark:text-white">Rp 0</p>
            </div>

            <!-- Confirmation Button -->
            <div class="flex justify-center">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300 transform hover:scale-105">
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>
</div>

<x-footer />

<!-- Flowbite JS -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>

<script>
    // Retrieve and set up initial data
    const selectedRoom = localStorage.getItem('selectedRoom');
    const selectedPackage = localStorage.getItem('selectedPackage');
    const price = localStorage.getItem('price');

    // Extract duration from package name (format: "1 jam", "2 jam")
    function getPackageDuration() {
        if (!selectedPackage) return 0;

        // Mengambil angka di awal string sebelum kata "jam"
        const durationMatch = selectedPackage.match(/^(\d+)\s*jam/i);
        if (durationMatch) {
            console.log('Duration found:', durationMatch[1], 'hours');
            return parseInt(durationMatch[1]);
        }
        console.log('No duration found in package name:', selectedPackage);
        return 0;
    }

    // Function to format datetime for display
    function formatDateTime(date) {
        return date.toLocaleString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Add this script to your payment-confirmation.blade.php
    document.addEventListener('DOMContentLoaded', function() {
        // Get form element
        const form = document.querySelector('form');

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate required fields
            const roomName = document.getElementById('form-room-name').value;
            const packageName = document.getElementById('form-package-name').value;
            const price = document.getElementById('form-price').value;
            const startTime = document.getElementById('order_date').value;
            const endTime = document.getElementById('end_time').value;
            const fullName = document.getElementById('full_name').value;
            const email = document.getElementById('email').value;
            const paymentMethod = document.getElementById('payment_method').value;

            if (!roomName || !packageName || !price) {
                alert('Data booking tidak lengkap. Silakan pilih room dan package terlebih dahulu.');
                return;
            }

            if (!startTime || !endTime) {
                alert('Silakan pilih waktu booking.');
                return;
            }

            if (!fullName || !email || !paymentMethod) {
                alert('Silakan lengkapi semua data yang diperlukan.');
                return;
            }

            // If validation passes, submit the form
            this.submit();
        });

        // Function to handle datetime-local input change
        function handleDateTimeChange() {
            const orderDateInput = document.getElementById('order_date');
            const duration = getPackageDuration();
            console.log('Package duration:', duration, 'hours');

            orderDateInput.addEventListener('change', function() {
                const startTime = new Date(this.value);
                if (!isNaN(startTime.getTime()) && duration > 0) {
                    // Calculate end time by adding package duration hours
                    const endTime = new Date(startTime.getTime() + (duration * 60 * 60 * 1000));

                    // Format end time for display
                    const endTimeFormatted = formatDateTime(endTime);
                    console.log('End time calculated:', endTimeFormatted);

                    // Update the end time display
                    const endTimeDisplay = document.getElementById('end-time-display');
                    if (endTimeDisplay) {
                        endTimeDisplay.textContent = endTimeFormatted;
                    }

                    // Store the end time in a hidden input for form submission
                    const endTimeInput = document.getElementById('end_time');
                    if (endTimeInput) {
                        endTimeInput.value = endTime.toISOString().slice(0, 16);
                    }
                }
            });
        }

        handleDateTimeChange();
    });



    // Check if the data is available and populate the HTML elements
    if (selectedRoom && selectedPackage && price) {
        document.getElementById('room-name').textContent = selectedRoom;
        document.getElementById('package-name').textContent = selectedPackage;
        document.getElementById('price').textContent = `Rp ${formatPrice(price)}`;
        document.getElementById('total-payment').textContent = `Rp ${formatPrice(price)}`;

        // Initialize datetime handler
        handleDateTimeChange();
    } else {
        console.error('Missing booking data!');
    }

    // Function to format price
    function formatPrice(amount) {
        return new Intl.NumberFormat('id-ID').format(amount);
    }
</script>

</body>
</html>
