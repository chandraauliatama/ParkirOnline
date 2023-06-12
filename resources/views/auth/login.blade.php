<x-guest-layout>
    <x-slot name="image">
        <img class="rounded-3xl" src="{{ asset('images/loginHero.png') }}">
    </x-slot>

    <div class="flex w-full items-center justify-center space-y-8 bg-white lg:w-1/2">
        <div class="w-full px-8 md:px-32 lg:px-24">
            <form method="POST" action="{{ route('login') }}" class="rounded-md bg-white p-5 shadow-2xl">
                @csrf
                <div class="text-center">
                    <a href="{{ route('dashboard') }}"
                       class="mb-5 flex items-center justify-center text-2xl font-semibold text-gray-900 dark:text-white">
                        <img src="{{ asset('images/logo.png') }}" class="h-16 sm:h-16" alt="ParkirOnline Logo" />
                    </a>
                </div>
                <h1 class="mb-1 text-2xl font-bold text-blue-500">Selamat Datang!</h1>
                <p class="mb-8 text-sm font-normal text-gray-600">Silahkan login untuk mengakses fitur</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Email --}}

                <x-text-input id="login" class="mt-1 block w-full" type="text" name="login" :value="old('login')"
                              placeholder="Username" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                {{-- Password --}}
                <x-text-input id="password" class="mt-6 block w-full" type="password" name="password"
                              placeholder="Password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <x-primary-button class="mt-5">Masuk</x-primary-button>

                <div class="mt-4 flex justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="ml-2text-sm cursor-pointer text-sm font-normal text-gray-600 transition-all duration-500 hover:-translate-y-1 hover:text-green-500">
                            Lupa password?
                        </a>
                    @endif
                </div>

            </form>
        </div>

    </div>
</x-guest-layout>
