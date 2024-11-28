<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col justify-between items-center bg-gray-100 dark:bg-gray-900 relative">
    <!-- Logo di pojok kanan atas -->
    <div class="absolute top-12 left-20 flex items-center space-x-4">
        <a href="{{ route('landing') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-20 h-20">
            <span class="text-5xl font-semibold text-black dark:text-gray-300">FunksNet</span>
        </a>
    </div>

    <!-- Form di pojok kiri bawah dengan ukuran setengah layar -->
    <div class="w-1/2 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg absolute bottom-6 left-6 z-10
                @if(Route::is('login')) h-[66vh] @else h-[80vh] @endif">
        {{ $slot }}
    </div>

    <div class="absolute right-36 top-1/2 transform -translate-y-1/2 w-[634px] h-[852px] overflow-hidden">
        <!-- Slides -->
        <div id="slider" class="flex transition-transform duration-700 rounded-xl">
            <!-- Slide 1 -->
            <div class="slide w-full flex-shrink-0">
                <img src="{{ asset('images/net1-login.png') }}" class="w-full h-full object-cover block" alt="Slide 1">
                <div class="text-content hidden">
                    <p class="first-text text-center text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                        Nikmati Kenyamanan Maksimal dengan Sofa yang Nyaman
                    </p>
                    <p class="second-text text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                        Di FUNKS NET, kenyamananmu adalah prioritas utama kami. Bersantailah di sofa yang empuk dan nyaman, sambil menikmati permainan favoritmu. Tak hanya sekadar warnet, kami menyediakan tempat yang bisa membuatmu merasa betah berlama-lama!
                    </p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide w-full flex-shrink-0">
                <img src="{{ asset('images/net2.png') }}" class="w-full h-full object-cover block rounded-xl" alt="Slide 2">
                <div class="text-content hidden">
                    <p class="first-text text-center text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                        Ruang Tunggu yang Nyaman
                    </p>
                    <p class="second-text text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                        Kami juga menyediakan ruang tunggu yang nyaman bagi kamu yang ingin bersantai sejenak, menunggu teman, atau sekadar beristirahat sejenak dari layar. Ruang tunggu ini dirancang untuk memberikan kenyamanan maksimal dengan suasana yang cozy.
                    </p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide w-full flex-shrink-0">
                <img src="{{ asset('images/net3.png') }}" class="w-full h-full object-cover block rounded-xl" alt="Slide 3">
                <div class="text-content hidden">
                    <p class="first-text text-center text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                        Rasakan Koneksi Tercepat untuk Semua Kebutuhanmu
                    </p>
                    <p class="second-text text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                        Kami memastikan kamu memiliki koneksi internet yang stabil dan cepat. Apapun aktivitasmu, baik bermain game, streaming, atau bekerja, kami siap mendukungmu dengan kualitas terbaik.
                    </p>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="slide w-full flex-shrink-0">
                <img src="{{ asset('images/net4.png') }}" class="w-full h-full object-cover block rounded-xl" alt="Slide 4">
                <div class="text-content hidden">
                    <p class="first-text text-center text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                        Jelajahi Dunia Digital dengan Kecepatan Tinggi
                    </p>
                    <p class="second-text text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
                        Internet cepat tanpa batas kini hadir di FUNKS NET. Bermain, bekerja, atau menikmati hiburan menjadi lebih mudah dengan koneksi stabil dan berkualitas premium.
                    </p>
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="slide w-full flex-shrink-0">
                <img src="{{ asset('images/net5.png') }}" class="w-full h-full object-cover block rounded-xl" alt="Slide 5">
                <div class="text-content hidden">
                    <p class="first-text text-center text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg">
                        Wujudkan Produktivitas Maksimal di Tempat Nyaman
                    </p>
                    <p class="second-text text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center">
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
            <p id="first-text" class="text-lg font-bold text-white bg-black/50 px-6 py-2 rounded-lg"></p>
            <!-- Second Text -->
            <p id="second-text" class="text-sm text-white bg-black/50 px-4 py-2 mx-6 rounded-lg text-center"></p>
        </div>
    </div>
</div>

<script>
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
</script>
</body>
</html>
