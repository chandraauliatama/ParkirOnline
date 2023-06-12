<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'block w-full bg-[#79c39b] mt-5 py-2 rounded-2xl hover:bg-[#20ba67] hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2 active:bg-[#20ba67] focus:bg-[#20ba67] focus:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-[#20ba67] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
