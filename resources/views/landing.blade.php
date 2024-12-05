<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FunksNet | Landing Page</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Enable smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Transition effects for menu item */
        .menu-item {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<x-navbar />

<!-- Home Section -->
<section id="home">
    <!-- Image Slider -->
    <div class="relative flex justify-center items-center mt-6">
        <!-- Slider Container -->
        <div class="relative w-[1340px] h-[750px] overflow-hidden rounded-3xl">
            <!-- Slides -->
            <div id="slider" class="flex transition-transform duration-700">
                <div class="slide w-full flex-shrink-0">
                    <img src="{{ asset('images/net1.png') }}" class="w-full h-auto object-cover" alt="Slide 1">
                    <div class="text-content hidden">
                        <p class="first-text text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                            Nikmati Kenyamanan Maksimal dengan Sofa yang Nyaman
                        </p>
                        <p class="second-text text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                            Di FUNKS NET, kenyamananmu adalah prioritas utama kami. Bersantailah di sofa yang empuk dan nyaman, sambil menikmati permainan favoritmu. Tak hanya sekadar warnet, kami menyediakan tempat yang bisa membuatmu merasa betah berlama-lama!
                        </p>
                    </div>
                </div>
                <div class="slide w-full flex-shrink-0">
                    <img src="{{ asset('images/net2.png') }}" class="w-full h-auto object-cover" alt="Slide 2">
                    <div class="text-content hidden">
                        <p class="first-text text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                            Ruang Tunggu yang Nyaman
                        </p>
                        <p class="second-text text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                            Kami juga menyediakan ruang tunggu yang nyaman bagi kamu yang ingin bersantai sejenak, menunggu teman, atau sekadar beristirahat sejenak dari layar. Ruang tunggu ini dirancang untuk memberikan kenyamanan maksimal dengan suasana yang cozy.
                        </p>
                    </div>
                </div>
                <div class="slide w-full flex-shrink-0">
                    <img src="{{ asset('images/net3.png') }}" class="w-full h-auto object-cover" alt="Slide 3">
                    <div class="text-content hidden">
                        <p class="first-text text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                            Rasakan Koneksi Tercepat untuk Semua Kebutuhanmu
                        </p>
                        <p class="second-text text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                            Kami memastikan kamu memiliki koneksi internet yang stabil dan cepat. Apapun aktivitasmu, baik bermain game, streaming, atau bekerja, kami siap mendukungmu dengan kualitas terbaik.
                        </p>
                    </div>
                </div>
                <div class="slide w-full flex-shrink-0">
                    <img src="{{ asset('images/net4.png') }}" class="w-full h-auto object-cover" alt="Slide 4">
                    <div class="text-content hidden">
                        <p class="first-text text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                            Jelajahi Dunia Digital dengan Kecepatan Tinggi
                        </p>
                        <p class="second-text text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                            Internet cepat tanpa batas kini hadir di FUNKS NET. Bermain, bekerja, atau menikmati hiburan menjadi lebih mudah dengan koneksi stabil dan berkualitas premium.
                        </p>
                    </div>
                </div>
                <div class="slide w-full flex-shrink-0">
                    <img src="{{ asset('images/net5.png') }}" class="w-full h-auto object-cover" alt="Slide 5">
                    <div class="text-content hidden">
                        <p class="first-text text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                            Wujudkan Produktivitas Maksimal di Tempat Nyaman
                        </p>
                        <p class="second-text text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                            Dengan suasana yang kondusif dan fasilitas lengkap, FUNKS NET adalah tempat terbaik untuk bekerja, belajar, atau bermain game. Kami mendukung semua kebutuhan digitalmu!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Left Arrow -->
            <button id="prev" class="absolute left-5 top-1/2 transform -translate-y-1/2 z-20 bg-black/50 text-white p-4 rounded-full hover:bg-black/70">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Arrow -->
            <button id="next" class="absolute right-5 top-1/2 transform -translate-y-1/2 z-20 bg-black/50 text-white p-4 rounded-full hover:bg-black/70">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Text Overlay Positioned at Bottom -->
            <div class="absolute bottom-4 left-0 right-0 z-10 flex flex-col items-center space-y-2">
                <!-- First Text -->
                <p id="first-text" class="text-2xl font-bold text-white bg-black/50 px-6 py-2 rounded-lg"></p>
                <!-- Second Text -->
                <p id="second-text" class="text-lg text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center"></p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <!-- Two Column Section -->
    <div class="flex flex-col md:flex-row justify-start items-start gap-8 mt-12 px-12">
        <!-- Left Column: Text -->
        <div class="w-full md:w-1/2 text-center md:text-left mt-20">
            <h2 class="text-9xl font-black text-black dark:text-white mb-4">
                About Us
            </h2>
            <p class="text-lg text-justify text-gray-700 dark:text-gray-300 mb-6">
                Selamat datang di Funk Net! Kami adalah warnet modern yang mengutamakan kenyamanan dan kualitas layanan bagi para pengguna. Di Funk Net, kami memahami pentingnya suasana yang nyaman saat Anda bermain game, bekerja, atau berselancar di internet. Oleh karena itu, kami menghadirkan berbagai fasilitas unggulan untuk memastikan pengalaman terbaik.
            </p>
            <div class="text-lg text-justify text-gray-700 dark:text-gray-300 mb-6">
                <p>Di Funk Net, Anda bisa menikmati:</p>
                <ul class="list-disc list-inside">
                    <li>PC dengan Spesifikasi Tinggi yang siap memenuhi kebutuhan gaming dan pekerjaan berat Anda.</li>
                    <li>Sofa yang Nyaman untuk memastikan Anda dapat bersantai dengan tenang saat menunggu giliran atau beristirahat sejenak.</li>
                    <li>Mini Bar yang menyediakan beragam snack dan minuman, sehingga Anda dapat tetap berenergi selama beraktivitas.</li>
                    <li>Mushola yang bersih dan nyaman untuk kemudahan beribadah tanpa harus meninggalkan lokasi.</li>
                    <li>Kamar Mandi yang Bersih dengan fasilitas yang terawat, memastikan kenyamanan Anda selama berada di sini.</li>
                </ul>
            </div>
            <p class="text-lg text-justify text-gray-700 dark:text-gray-300 mb-6">
                Kami selalu berusaha memberikan pelayanan yang ramah dan fasilitas yang memadai untuk memenuhi kebutuhan para pelanggan. Funk Net adalah pilihan tepat bagi Anda yang mencari warnet dengan kenyamanan maksimal dan teknologi terbaik. Kunjungi kami dan rasakan pengalaman yang berbeda!
            </p>
        </div>

        <!-- Right Column: Image -->
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('images/aboutus.png') }}" alt="Feature Image" class="rounded-lg w-[657px] h-[932px] object-cover shadow-lg">
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services">
    <div class="mt-16 px-12">
        <h2 class="text-5xl font-bold text-black dark:text-white mb-14 text-start">Our Services</h2>
        <p class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 text-start">Select Room</p>

        <!-- Room Images with text below each -->
        <div class="flex justify-center gap-8 w-full">
            @forelse($rooms as $room)
                <div id="{{ strtolower($room->name) }}-room"
                     class="overflow-hidden rounded-3xl shadow-lg cursor-pointer transform transition-all duration-300 hover:scale-105 hover:-translate-y-2 hover:shadow-lg hover:bg-gray-100 hover:dark:bg-gray-800"
                     onclick="updateCard('{{ strtolower($room->name) }}')">
                    <img src="{{ asset('images/' .
                    ($room->name == 'Regular Room' ? 'regular.png' :
                    ($room->name == 'VIP Room' ? 'vip.png' :
                    ($room->name == 'VVIP Room' ? 'vvip.png' : strtolower($room->name) . '.png'))
                    )) }}"
                         alt="{{ $room->name }}"
                         class="w-[430px] h-[200px] object-cover transition-transform duration-300 hover:scale-105">
                    <p class="text-center mt-2 text-lg font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300 hover:text-gray-900 dark:hover:text-white">
                        {{ $room->name }}
                    </p>
                </div>
            @empty
                <div class="w-full text-center py-12">
                    <div class="mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Ruangan Tidak Tersedia
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                        Ruangan sedang dalam pemeliharaan atau pembaruan. Silakan hubungi staff kami untuk informasi ketersediaan ruangan.
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Room Details Section -->
        @if(count($rooms) > 0)
            <div id="room-card" class="flex flex-wrap justify-center max-h-[50vh] mt-20 overflow-y-auto opacity-0 transform scale-95 transition-all duration-500">
                <div class="w-full bg-[#D9D9D9] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-5 pb-5">
                        <h5 id="room-title" class="text-xl mt-6 font-semibold tracking-tight text-gray-900 dark:text-white">
                            Select a Room to See Details
                        </h5>

                        <div class="flex items-center mt-2.5 mb-5">
                <span id="remaining-capacity" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Remaining Capacity
                </span>
                            <span id="room-capacity" class="ml-2 text-xl font-semibold text-gray-900 dark:text-white">
                    0/0
                </span>
                        </div>

                        <div class="mb-5">
                            <label for="package-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Select Package
                            </label>
                            <select id="package-select"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    onchange="handlePackageSelect(this)">
                                <option value="">Choose a package</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between">
                            <span id="product-price" class="text-3xl font-bold text-gray-900 dark:text-white">Rp 0</span>
                            <button id="payment-button"
                                    onclick="proceedToPayment()"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Food & Drink Section -->
<section id="foodDrink">
    <div class="mt-16 px-12">
        <h2 class="text-3xl font-bold text-black dark:text-white mb-20 text-start flex justify-between items-center">
            <span>Food & Drink</span>
            <span class="text-sm text-gray-500">Hanya Bisa Memesan di Tempat</span>
        </h2>
        <!-- Centered Grid Container -->
        <div class="flex justify-center">
            <div id="foodGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 w-full max-w-screen-xl">
                @forelse ($foodDrinks as $item)
                    <div class="food-card max-w-sm bg-[#D9D9D9] border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-100 hover:dark:bg-gray-800">
                        <!-- Food Item Image -->
                        <a href="{{ $item->link ?? '#' }}">
                            <img class="rounded-t-lg px-12 mt-6 transition-all duration-300 transform hover:scale-110"
                                 src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->name }} Image">
                        </a>
                        <div class="p-5 flex flex-col justify-between flex-grow">
                            <!-- Food Item Title -->
                            <a href="{{ $item->link ?? '#' }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white transition-all duration-300 hover:text-gray-900 dark:hover:text-white">
                                    {{ $item->name }}
                                </h5>
                            </a>
                            <!-- Food Item Description -->
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 transition-colors duration-300 hover:text-gray-900 dark:hover:text-white flex-grow min-h-[50px] text-ellipsis overflow-hidden">
                                {{ $item->description }}
                            </p>
                            <!-- Food Item Price -->
                            <span class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            Menu Tidak Tersedia
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                            Menu makanan dan minuman sedang dalam pembaruan. Silakan hubungi staff kami untuk informasi menu terkini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<div id="scrollProgress" style="position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px; border-radius: 50%; border: 4px solid #d3d3d3;"></div>

<x-footer />

<script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
<script>
    // Script code for handling the scroll progress
    const circle = new ProgressBar.Circle('#scrollProgress', {
        color: '#3D45E8', // Warna progress
        strokeWidth: 6,    // Ketebalan garis progress
        trailWidth: 6,     // Ketebalan trail (background)
        trailColor: '#d3d3d3', // Warna trail
        duration: 1400,    // Durasi animasi
        easing: 'easeInOut', // Jenis easing
    });

    function updateProgress() {
        const scrollTop = window.scrollY;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = scrollTop / scrollHeight;
        circle.set(scrollPercent);
    }

    window.addEventListener('scroll', updateProgress);

    document.getElementById('scrollProgress').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    updateProgress();

    // Function to add active class based on the section in the viewport
    function setActiveLink() {
        const sections = document.querySelectorAll("section");
        const links = document.querySelectorAll(".menu-item");

        let currentSection = null;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            const scrollPosition = window.scrollY + window.innerHeight / 2; // Middle of the viewport

            // Adjusted condition to detect if the section is at least 25% visible in the viewport
            if (scrollPosition >= sectionTop + sectionHeight / 6 && scrollPosition <= sectionTop + sectionHeight - sectionHeight / 6) {
                currentSection = section.getAttribute("id");
            }
        });

        // If no section is in view, remove active state from all links
        if (!currentSection) {
            links.forEach(link => {
                link.classList.remove("bg-black", "text-white");
                link.classList.add("text-gray-900", "hover:bg-gray-100");
            });
            return; // Exit the function early
        }

        // Otherwise, set active state based on the current section
        links.forEach(link => {
            if (link.getAttribute("href").includes(currentSection)) {
                link.classList.add("bg-black", "text-white");
                link.classList.remove("text-gray-900", "hover:bg-gray-100");
            } else {
                link.classList.remove("bg-black", "text-white");
                link.classList.add("text-gray-900", "hover:bg-gray-100");
            }
        });
    }

    // Event listener for scroll event
    window.addEventListener("scroll", setActiveLink);

    // Call it initially to set the active link on page load
    setActiveLink();

    // Optional: If you want smooth scroll when clicking the links
    document.querySelectorAll('.menu-item').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Get target section based on the link's href
            const targetSection = document.querySelector(this.getAttribute('href'));

            // Offset navbar height for scroll position (adjust this if your navbar height changes)
            const navbarHeight = document.getElementById('navbar').offsetHeight;

            // Scroll target section into view with an offset to account for the navbar
            window.scrollTo({
                top: targetSection.offsetTop - navbarHeight, // Subtract navbar height
                behavior: 'smooth'
            });
        });
    });

    // JavaScript for Slider Functionality
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slide');
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    const firstText = document.getElementById('first-text');
    const secondText = document.getElementById('second-text');
    let index = 0;
    let autoSlideInterval;

    // Function to Update Text Content
    const updateTextContent = () => {
        const activeSlide = slides[index];
        const activeTextContent = activeSlide.querySelector('.text-content');
        const newFirstText = activeTextContent.querySelector('.first-text').textContent;
        const newSecondText = activeTextContent.querySelector('.second-text').textContent;

        firstText.textContent = newFirstText;
        secondText.textContent = newSecondText;
    };

    // Initialize Text
    updateTextContent();

    const moveSlider = (direction) => {
        const totalSlides = slides.length;
        index = (index + direction + totalSlides) % totalSlides;
        slider.style.transform = `translateX(-${index * 100}%)`;
        updateTextContent();
    };

    const startAutoSlide = () => {
        autoSlideInterval = setInterval(() => moveSlider(1), 5000); // Change slide every 5 seconds
    };

    const stopAutoSlide = () => {
        clearInterval(autoSlideInterval);
    };

    // Event Listeners
    prev.addEventListener('click', () => {
        stopAutoSlide();
        moveSlider(-1);
        startAutoSlide();
    });

    next.addEventListener('click', () => {
        stopAutoSlide();
        moveSlider(1);
        startAutoSlide();
    });

    // Start Auto Slide on Page Load
    startAutoSlide();

    // Clear localStorage on page load
    window.addEventListener('load', function() {
        localStorage.removeItem('selectedRoom');
        localStorage.removeItem('selectedPackage');
        localStorage.removeItem('price');
    });

    // Format the price with a thousands separator
    function formatPrice(price) {
        return new Intl.NumberFormat('id-ID').format(price);
    }

    // Pass the data from Laravel's Blade to JavaScript
    const rooms = @json($rooms);
    const packets = @json($packets);
    const roomPackets = @json($roomPackets);

    // Create room data map for easy access
    const roomData = {};

    rooms.forEach(room => {
        roomData[room.id] = {
            title: room.name,
            capacity: `${room.remaining_capacity}/${room.capacity}`,
            packages: []
        };
    });

    roomPackets.forEach(roomPacket => {
        const roomId = roomPacket.room_id;
        const packet = packets.find(p => p.id === roomPacket.packet_id);

        if (roomData[roomId] && packet) {
            roomData[roomId].packages.push({
                id: packet.id,
                price: roomPacket.price,
                label: packet.name
            });
        }
    });

    function updateCard(roomName) {
        const room = Object.values(roomData).find(r => r.title.toLowerCase() === roomName);

        if (room) {
            // Update room details in the UI
            document.getElementById('room-title').textContent = room.title;
            document.getElementById('remaining-capacity').textContent = 'Remaining Capacity';
            document.getElementById('room-capacity').textContent = room.capacity;

            // Update package select options
            const packageSelect = document.getElementById('package-select');
            packageSelect.innerHTML = '<option value="">Choose a package</option>'; // Add default option

            room.packages.forEach(pkg => {
                const option = document.createElement('option');
                option.value = pkg.price;
                option.textContent = `${pkg.label} - Rp ${formatPrice(pkg.price)}`;
                packageSelect.appendChild(option);
            });

            // Reset price display
            document.getElementById('product-price').textContent = 'Rp 0';

            // Store selected room and clear package data
            localStorage.setItem('selectedRoom', room.title);
            localStorage.removeItem('selectedPackage');
            localStorage.removeItem('price');

            // Show the room details section with animation
            const roomCard = document.getElementById('room-card');
            roomCard.classList.remove('opacity-0', 'scale-95');
            roomCard.classList.add('opacity-100', 'scale-100');
        }
    }

    // Handle package selection change
    document.getElementById('package-select').addEventListener('change', function() {
        const selectedPrice = this.value;
        const selectedOption = this.options[this.selectedIndex];

        if (!selectedPrice || selectedPrice === "") {
            document.getElementById('product-price').textContent = 'Rp 0';
            localStorage.removeItem('selectedPackage');
            localStorage.removeItem('price');
            return;
        }

        const selectedPackage = selectedOption.text;
        document.getElementById('product-price').textContent = `Rp ${formatPrice(selectedPrice)}`;

        // Store selected package data
        localStorage.setItem('selectedPackage', selectedPackage);
        localStorage.setItem('price', selectedPrice);
    });

    // Handle payment button click
    document.getElementById('payment-button').addEventListener('click', function() {
        const selectedRoom = localStorage.getItem('selectedRoom');
        const selectedPackage = localStorage.getItem('selectedPackage');
        const price = localStorage.getItem('price');

        console.log('Payment button clicked:', {
            selectedRoom,
            selectedPackage,
            price
        });

        if (!selectedRoom || !selectedPackage || !price) {
            alert('Please select both room and package before proceeding to payment.');
            return;
        }

        // Redirect to payment confirmation page
        window.location.href = '/payments/payment-confirmation';
    });

    // Function to generate and display food cards
    function displayFoodItems() {
        const foodGrid = document.getElementById('foodGrid');
        if (!foodGrid) {
            console.error('Food grid element not found');
            return;
        }
        console.log('Food Grid found:', foodGrid);

        foodItems.forEach(item => {
            // Create a new div element for the card
            const card = document.createElement('div');
            card.classList.add(
                'max-w-sm', 'bg-[#D9D9D9]', 'border', 'border-gray-200', 'rounded-lg', 'shadow',
                'dark:bg-gray-800', 'dark:border-gray-700', 'flex', 'flex-col', 'h-full',
                'transform', 'transition-all', 'duration-300', 'hover:scale-105', 'hover:shadow-xl',
                'hover:bg-gray-100', 'hover:dark:bg-gray-800'
            );

            // Create the image link
            const imgLink = document.createElement('a');
            imgLink.setAttribute('href', item.link);
            const img = document.createElement('img');
            img.classList.add(
                'rounded-t-lg', 'px-12', 'mt-6', 'transition-all', 'duration-300', 'transform', 'hover:scale-110'
            );
            img.setAttribute('src', `images/${item.image}`);
            img.setAttribute('alt', 'Food Image');
            imgLink.appendChild(img);
            card.appendChild(imgLink);

            // Create the card body (content below the image)
            const cardBody = document.createElement('div');
            cardBody.classList.add(
                'p-5', 'flex', 'flex-col', 'justify-between', 'flex-grow' // This ensures the card body takes up remaining space
            );

            // Title link
            const titleLink = document.createElement('a');
            titleLink.setAttribute('href', item.link);
            const title = document.createElement('h5');
            title.classList.add(
                'mb-2', 'text-2xl', 'font-bold', 'tracking-tight', 'text-gray-900', 'dark:text-white',
                'transition-all', 'duration-300', 'hover:text-gray-900', 'dark:hover:text-white'
            );
            title.textContent = item.name;
            titleLink.appendChild(title);
            cardBody.appendChild(titleLink);

            // Description
            const description = document.createElement('p');
            description.classList.add(
                'mb-3', 'font-normal', 'text-gray-700', 'dark:text-gray-400', 'transition-colors', 'duration-300',
                'hover:text-gray-900', 'dark:hover:text-white', 'flex-grow', 'min-h-[50px]',
                'text-ellipsis', 'overflow-hidden' // Prevent text overflow
            );
            description.textContent = item.description;
            cardBody.appendChild(description);

            // Footer section for price (or any additional info)
            const cardFooter = document.createElement('div');
            cardFooter.classList.add('mt-auto'); // This will push the footer content to the bottom of the card

            // Append the card body to the card
            card.appendChild(cardBody);

            // Append the card to the grid container
            foodGrid.appendChild(card);
        });
    }

    // Call the function to display food items
    displayFoodItems();
</script>

</body>

</html>
