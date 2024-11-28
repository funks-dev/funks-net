<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Title and Description -->
        <div class="text-start mb-6">
            <h2 class="text-3xl font-black text-gray-800 dark:text-white">{{ __('Create an Account') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('Describe yourself clearly so that there are no mistake') }}</p>
        </div>

        <!-- Sign In with Google Button -->
        <div class="mt-6">
            <button type="button" class="w-full flex items-center justify-center bg-gray-300 text-black font-bold text-l py-1 px-1 rounded-3xl hover:bg-[#A5A5A5] transition ease-in-out duration-150 gap-4">
                <!-- Google Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="42" height="42" viewBox="0 0 48 48">
                    <path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
                {{ __('Sign In with Google') }}
            </button>
        </div>

        <!-- OR Line -->
        <div class="my-6 flex items-center">
            <hr class="flex-grow border-gray-300 dark:border-gray-700" />
            <span class="mx-4 text-gray-600 dark:text-gray-400">{{ __('or') }}</span>
            <hr class="flex-grow border-gray-300 dark:border-gray-700" />
        </div>

        <!-- First Name and Last Name -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="given-name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms of Service Checkbox -->
        <div class="mt-4 flex items-center">
            <x-text-input type="checkbox" name="terms" id="terms" required />
            <label for="terms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Yes, I understand and agree to the Funks Net Terms of Service') }}
            </label>
        </div>

        <div class="flex flex-col items-center justify-end mt-4 gap-4">
            <x-primary-button class="w-full flex items-center justify-center">
                {{ __('Create Account') }}
            </x-primary-button>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already have an account?') }}
                </span>
                <a class="underline text-sm text-blue-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Sign In') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
