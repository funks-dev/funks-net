<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Landing Page</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<x-navbar />

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
