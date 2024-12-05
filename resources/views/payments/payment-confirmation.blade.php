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

            <!-- Hidden inputs untuk booking information -->
            <input type="hidden" name="room_name" id="form-room-name">
            <input type="hidden" name="package_name" id="form-package-name">
            <input type="hidden" name="price" id="form-price">
            <input type="hidden" name="booking_info" id="booking-info">

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
                    <input type="datetime-local"
                           id="end_time"
                           name="end_time"
                           class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white bg-gray-100"
                           disabled
                           required />
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
    // Main booking data handling
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve stored data
        const selectedRoom = localStorage.getItem('selectedRoom');
        const selectedPackage = localStorage.getItem('selectedPackage');
        const price = localStorage.getItem('price');

        // Function to format price
        function formatPrice(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
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

        // Extract duration from package name
        function getPackageDuration() {
            if (!selectedPackage) return 0;
            const durationMatch = selectedPackage.match(/^(\d+)\s*jam/i);
            return durationMatch ? parseInt(durationMatch[1]) : 0;
        }

        // Function to format date for input
        function formatDateForInput(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            const hours = String(d.getHours()).padStart(2, '0');
            const minutes = String(d.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        // Function to validate booking time
        function validateBookingTime(startTime, endTime) {
            const now = new Date();
            const minimumTime = new Date(now.getTime() + (60 * 60 * 1000));
            const start = new Date(startTime);
            const end = new Date(endTime);

            if (start < minimumTime) {
                alert('Start time must be at least 1 hour from now');
                return false;
            }

            if (end <= start) {
                alert('End time must be after start time');
                return false;
            }

            return true;
        }

        // Initialize form
        function initializeForm() {
            const form = document.querySelector('form');
            if (!form) return;

            // Populate form data
            if (selectedRoom && selectedPackage && price) {
                document.getElementById('room-name').textContent = selectedRoom;
                document.getElementById('package-name').textContent = selectedPackage;
                document.getElementById('price').textContent = `Rp ${formatPrice(price)}`;
                document.getElementById('total-payment').textContent = `Rp ${formatPrice(price)}`;

                document.getElementById('form-room-name').value = selectedRoom;
                document.getElementById('form-package-name').value = selectedPackage;
                document.getElementById('form-price').value = price;
                document.getElementById('booking-info').value = JSON.stringify({
                    room_name: selectedRoom,
                    package_name: selectedPackage,
                    price: price
                });
            } else {
                console.error('Missing booking data!');
                return;
            }

            // Setup datetime inputs
            const orderDateInput = document.getElementById('order_date');
            const endTimeInput = document.getElementById('end_time');

            if (orderDateInput && endTimeInput) {
                // Set minimum time (1 hour from now)
                const now = new Date();
                now.setMinutes(now.getMinutes() + 60);
                now.setSeconds(0);
                now.setMilliseconds(0);

                const minDateTime = formatDateForInput(now);
                orderDateInput.min = minDateTime;
                orderDateInput.value = minDateTime;

                // Handle start time change
                orderDateInput.addEventListener('change', function() {
                    const startTime = new Date(this.value);
                    const duration = getPackageDuration();

                    if (!isNaN(startTime.getTime()) && duration > 0) {
                        const endTime = new Date(startTime.getTime());
                        endTime.setTime(startTime.getTime() + (duration * 60 * 60 * 1000));
                        endTimeInput.value = formatDateForInput(endTime);

                        // Create hidden input for end time
                        const hiddenEndTime = document.createElement('input');
                        hiddenEndTime.type = 'hidden';
                        hiddenEndTime.name = 'end_time';
                        hiddenEndTime.value = formatDateForInput(endTime);

                        // Replace existing hidden input if any
                        const existingHidden = document.querySelector('input[name="end_time"][type="hidden"]');
                        if (existingHidden) {
                            existingHidden.remove();
                        }
                        form.appendChild(hiddenEndTime);
                    }
                });

                // Trigger initial calculation
                orderDateInput.dispatchEvent(new Event('change'));
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const startTime = orderDateInput.value;
                const endTime = endTimeInput.value;

                if (!validateBookingTime(startTime, endTime)) {
                    return;
                }

                const requiredFields = {
                    'form-room-name': 'Room',
                    'form-package-name': 'Package',
                    'form-price': 'Price',
                    'order_date': 'Start Time',
                    'full_name': 'Full Name',
                    'email': 'Email',
                    'payment_method': 'Payment Method'
                };

                let isValid = true;
                for (const [id, label] of Object.entries(requiredFields)) {
                    const field = document.getElementById(id);
                    if (!field?.value) {
                        alert(`${label} is required!`);
                        isValid = false;
                        break;
                    }
                }

                if (!document.getElementById('booking-info')?.value) {
                    alert('Booking information is missing!');
                    isValid = false;
                }

                if (isValid) {
                    this.submit();
                }
            });
        }

        // Initialize
        try {
            initializeForm();
        } catch (error) {
            console.error('Error initializing form:', error);
            alert('An error occurred while loading the form. Please try again.');
        }
    });
</script>

</body>
</html>
