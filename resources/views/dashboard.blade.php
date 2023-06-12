<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Menu Utama') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto max-w-7xl p-6 lg:p-8">
            <div class="mt-16">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
                    <div
                         class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Plat Nomormu:
                                {{ strtoupper(auth()->user()->plat_number) }}
                            </h2>
                        </div>
                    </div>

                    <div
                         class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Titik Lokasi Parkir: {{ auth()->user()->parkingPoint?->name ?? 'Motor Sudah Keluar' }}
                            </h2>
                        </div>
                    </div>

                    <div
                         class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Waktu Masuk: {{ auth()->user()->last_in ?? '-' }}
                            </h2>
                        </div>
                    </div>

                    <div
                         class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Waktu Keluar: {{ auth()->user()->last_out ?? '-' }}
                            </h2>
                        </div>
                    </div>

                    @php
                        $denahParkirUrl = Illuminate\Support\Facades\Storage::disk('public')->url($staticImages['denah_parkir']);
                    @endphp
                    <a href="{{ $denahParkirUrl }}" target="__blank"
                       class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Lihat Denah Lokasi Parkir
                            </h2>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" class="mx-6 h-6 w-6 shrink-0 self-center stroke-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="duration-250 flex scale-100 rounded-lg bg-white from-gray-700/50 via-transparent p-6 shadow-2xl shadow-gray-500/20 transition-all focus:outline focus:outline-2 focus:outline-blue-500 motion-safe:hover:scale-[1.01] dark:bg-gray-800/50 dark:bg-gradient-to-bl dark:shadow-none dark:ring-1 dark:ring-inset dark:ring-white/5">
                        <div class="flex w-full items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Ubah Profil
                            </h2>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" class="mx-6 h-6 w-6 shrink-0 self-center stroke-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
