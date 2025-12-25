<div class="max-w-7xl mx-auto py-8 px-4">
    <section class="bg-[#D1E9E3] py-12 md:py-20 px-4 text-center mb-8 rounded-2xl">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-[#3E6553] text-3xl md:text-5xl font-bold mb-4 leading-tight">
                Fresh Items That Deserve To Eat
            </h1>
            <p class="text-[#7A9C8C] text-base md:text-lg mb-8">
                Get your groceries items delivered in less than an hour
            </p>

            <div x-data="{ search: '' }" class="relative max-w-2xl mx-auto">
                <input type="text" x-model="search" placeholder="Search for grocery or store..."
                    class="w-full py-3 md:py-4 px-6 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-200 text-gray-600 pr-12 transition-all bg-white border-none">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    @if ($restaurants->count() > 0)
        <div class="bg-emerald-50/50 p-6 rounded-2xl font-sans">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-2">
                <h2 class="text-2xl font-bold text-slate-800">Highlights for you</h2>
                <span class="text-emerald-700 font-medium bg-emerald-100 px-3 py-1 rounded-full text-sm">
                    View All
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($restaurants as $restaurant)
                    <a href="{{route('web.main.restaurant.single', $restaurant->id)}}" wire:navigate
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 group">

                        <div class="relative h-40 flex items-center justify-between p-4 overflow-hidden rounded-t-xl bg-cover bg-center"
                            style="background-image: url('{{ $restaurant->banner ? asset('storage/' . $restaurant->banner) : asset('images/default-banner.jpg') }}');">
                            <div class="w-1/2 h-full flex items-center justify-center">
                                @if ($restaurant->logo)
                                    <img src="{{ asset('storage/' . $restaurant->logo) }}"
                                        alt="{{ $restaurant->business_name }}"
                                        class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-lg transform group-hover:scale-110 transition-transform">
                                @else
                                    <div
                                        class="w-16 h-16 bg-white/50 rounded-full flex items-center justify-center border border-emerald-200">
                                        <span
                                            class="text-2xl font-bold text-emerald-700">{{ substr($restaurant->business_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="w-1/2 pl-3">
                                <p
                                    class="text-emerald-800 text-[10px] font-black uppercase tracking-wider leading-tight">
                                    {{ $restaurant->type }}
                                </p>
                                <p class="text-emerald-600 text-[11px] mt-1 line-clamp-2 italic leading-snug">
                                    {{ is_array($restaurant->cuisines) ? implode(', ', $restaurant->cuisines) : $restaurant->cuisines }}
                                </p>
                            </div>

                            <div
                                class="absolute bottom-2 left-2 bg-white/95 backdrop-blur-sm px-2 py-1 rounded-md flex items-center shadow-sm border border-gray-100">
                                <svg class="w-3 h-3 text-emerald-600 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                                <span class="text-[10px] font-bold text-emerald-700">
                                    @if ($restaurant->latitude && $restaurant->longitude)
                                        {{ number_format($this->calculateDistance($this->lat, $this->lng, $restaurant->latitude, $restaurant->longitude), 1) }}km
                                    @else
                                        Local
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-slate-700 text-sm truncate pr-2">
                                    {{ $restaurant->business_name }}</h3>

                                <div
                                    class="flex items-center {{ $restaurant->is_open ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} px-1.5 py-0.5 rounded transition-colors">
                                    <span class="text-[8px] mr-1">{{ $restaurant->is_open ? '●' : '●' }}</span>
                                    <span class="text-[10px] font-bold uppercase tracking-tighter">
                                        {{ $restaurant->is_open ? 'Open' : 'Closed' }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-gray-400 text-[10px] leading-relaxed mb-3 line-clamp-1">
                                {{ $restaurant->business_address }}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-50 pt-3">
                                @if ($restaurant->minimum_order)
                                    <div class="text-[10px]">
                                        <span class="text-gray-400 block uppercase text-[8px]">Min Order</span>
                                        <span class="font-bold text-slate-600">${{ $restaurant->minimum_order }}</span>
                                    </div>
                                @endif

                                @if ($restaurant->avg_preparation_time)
                                    <div class="text-[10px] text-right">
                                        <span class="text-gray-400 block uppercase text-[8px]">Est. Time</span>
                                        <span class="font-bold text-slate-600">{{ $restaurant->avg_preparation_time }}
                                            mins</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
            <div class="text-6xl mb-4 opacity-50">🥗</div>
            <h2 class="text-2xl font-semibold text-gray-600 mb-2">No Restaurants Found</h2>
            <p class="text-gray-500 max-w-sm mx-auto px-4">Sorry, we couldn't find any partners in your current area.
                Try adjusting your search.</p>
        </div>
    @endif
</div>
