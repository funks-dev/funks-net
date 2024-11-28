<footer class="bg-black shadow dark:bg-gray-900 mt-20">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('landing') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="/images/logo.svg" class="h-8" alt="FunksNet Logo" />
                <span class="self-center text-2xl text-white font-semibold whitespace-nowrap dark:text-white">FunksNet</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#home" class="hover:underline me-4 md:me-6">Home</a>
                </li>
                <li>
                    <a href="#about" class="hover:underline me-4 md:me-6">About Us</a>
                </li>
                <li>
                    <a href="#services" class="hover:underline me-4 md:me-6">Our Services</a>
                </li>
                <li>
                    <a href="#foodDrink" class="hover:underline me-4 md:me-6">Food & Drink</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-white sm:text-center dark:text-gray-400">© 2024 <a href="{{ route('landing') }}" class="hover:underline">Funk.dev™</a>. All Rights Reserved.</span>
    </div>
</footer>
