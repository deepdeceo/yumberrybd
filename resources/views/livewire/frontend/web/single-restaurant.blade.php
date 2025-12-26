<div>
    <div x-data="{ showMap: false }" class="relative antialiased font-sans p-4 md:p-8">

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row overflow-hidden rounded-xl shadow-lg">

            <div class="bg-[#22a45d] text-white p-6 flex-1 flex flex-col justify-between relative">
                <div class="flex items-start gap-4">
                    <div class="bg-white p-2 rounded-lg w-20 h-20 flex items-center justify-center shrink-0">
                        <img src="{{ asset('storage/' . $partner->logo) }}" class="object-contain" alt="Logo">
                    </div>

                    <div class="flex-1">
                        <h2 class="text-2xl font-bold leading-tight">{{ $partner->business_name }}</h2>
                        <p class="mt-2 text-[11px] leading-tight text-white/80 max-w-[220px]">
                            {{ $partner->business_address }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button class="bg-white p-1.5 rounded text-gray-400 hover:text-red-500 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>

                        <button class="bg-white p-1.5 rounded text-[#22a45d] hover:bg-gray-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>

                        <button @click="showMap = true"
                            class="bg-white p-1.5 rounded text-[#22a45d] hover:bg-gray-100 shadow-sm transition-all border border-transparent active:scale-95"
                            title="View on Map">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex gap-8 mt-8 border-t border-white/20 pt-4">
                    <div>
                        <div class="text-xl font-bold">100%</div>
                        <div class="text-[10px] uppercase text-white/80">Positive Review</div>
                    </div>
                    <div>
                        <div class="text-xl font-bold">{{ $estimatedTime }} min</div>
                        <div class="text-[10px] uppercase text-white/80">Delivery Time</div>
                    </div>
                </div>
            </div>

            <div class="bg-[#ebf5ff] flex-1 flex items-center p-8">
                <div class="flex items-center gap-6 text-gray-800">
                    <div class="w-36 h-36 shrink-0 shadow-2xl rounded-full border-4 border-[#8b4513] overflow-hidden">
                        <img src="https://img.freepik.com/free-photo/top-view-cup-coffee-with-bubbles_23-2148762744.jpg"
                            class="object-cover w-full h-full">
                    </div>
                    <h1 class="text-3xl font-extrabold leading-tight">Elegant Coffee<br>And Treats</h1>
                </div>
            </div>
        </div>

        <div x-show="showMap" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>

            <div class="bg-white rounded-2xl w-full max-w-4xl overflow-hidden shadow-2xl">
                <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-800">Location: {{ $partner->name }}</h3>
                    <button @click="showMap = false" class="text-gray-400 hover:text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="w-full h-[450px]">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0"
                        marginwidth="0"
                        src="https://maps.google.com/maps?q={{ $partner->latitude }},{{ $partner->longitude }}&hl=en&z=15&output=embed">
                    </iframe>
                </div>

                <div class="p-4 bg-gray-50 text-center">
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $partner->latitude }},{{ $partner->longitude }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-[#22a45d] text-white rounded-full font-bold hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        Get Directions on Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-gray-50 min-h-screen p-4 md:p-8 font-sans antialiased" x-data="{ search: '', showFilter: false }">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h2 class="text-xl font-bold text-gray-800">All Products (14)</h2>

            <div class="flex flex-wrap items-center gap-6">
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer text-sm font-medium text-gray-600">
                        <input type="checkbox" wire:model.live="foodType" value="Veg"
                            class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"> Veg
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer text-sm font-medium text-gray-600">
                        <input type="checkbox" wire:model.live="foodType" value="Non-Veg"
                            class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500"> Non-Veg
                    </label>
                </div>

                <div class="flex items-center gap-2">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" placeholder="Search for items..." wire:model.live="search"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 w-64 bg-white shadow-sm text-sm">
                    </div>
                    <button
                        class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg bg-white text-gray-600 text-sm hover:bg-gray-50 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-8">
            <aside class="w-full md:w-64 space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">Categories</h3>
                    <div class="space-y-3">
                        @foreach ($ctg as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}"
                                    class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">Price Range</h3>
                    <input type="range" min="0" max="5000" wire:model.live="maxPrice"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-green-600">
                    <div class="flex justify-between mt-2 text-xs text-gray-400">
                        <span>BDT 0</span>
                        <span>BDT {{ $maxPrice }}</span>
                    </div>
                </div>
            </aside>

            <main class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


                    @foreach ($product as $show)
                        <div
                            class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 relative group cursor-pointer">
                            <div
                                class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm z-10">
                                5%
                            </div>

                            <div class="h-48 overflow-hidden bg-gray-100">

                                @if ($show->thumbnail)
                                    <img src="{{ asset('storage/' . $show->thumbnail) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="No Image"
                                        class="h-32 object-contain opacity-50">
                                @endif
                            </div>

                            <div class="p-4 text-center">
                                <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wider mb-1">
                                    {{ $show->category->name ?? 'No Category' }}</p>
                                <h4 class="font-bold text-gray-800 mb-1 line-clamp-1"> {{ $show->title }}</h4>

                                <div class="flex items-center justify-center gap-2">
                                    @php
                                        $originalPrice = $show->selling_price;
                                        $discountAmount = $show->discount_amount ?? 0;
                                        $finalPrice = $originalPrice;

                                        if ($discountAmount > 0) {
                                            if ($show->discount_type === 'percent') {
                                                $finalPrice = $originalPrice - $originalPrice * ($discountAmount / 100);
                                            } else {
                                                $finalPrice = $originalPrice - $discountAmount;
                                            }
                                        }
                                    @endphp

                                    {{-- যদি ডিসকাউন্ট থাকে তবেই আগের প্রাইসটি (Old Price) কাটা অবস্থায় দেখাবে --}}
                                    @if ($discountAmount > 0)
                                        <span class="text-xs text-gray-400 line-through">
                                            BDT {{ number_format($originalPrice, 2) }}
                                        </span>
                                    @endif

                                    <span class="text-lg font-bold text-green-600">
                                        BDT {{ number_format($finalPrice, 2) }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</div>
