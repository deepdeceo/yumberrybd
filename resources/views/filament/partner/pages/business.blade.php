<x-filament-panels::page>


    {{-- Leaflet CSS & Geocoder CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        /* ম্যাপের কন্টেইনার */
        #map {
            height: 500px;
            border-radius: 12px;
            z-index: 10 !important;
            /* ম্যাপের ইন্ডেক্স বাড়ানো হয়েছে */
            border: 1px solid #d1d5db;
        }

        /* সার্চ বক্স যদি হাইড হয়ে থাকে তবে জোর করে শো করানো */
        .leaflet-control-geocoder {
            z-index: 9999 !important;
            background: white;
            border: 2px solid rgba(0, 0, 0, 0.2);
            background-clip: padding-box;
        }

        .leaflet-control-geocoder-form input {
            color: black !important;
            /* টেক্সট কালার ফিক্স */
            padding: 5px;
        }
    </style>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-filament::card class="space-y-6">
            {{-- Form Fields --}}
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">দোকানের নাম</label>
                <x-filament::input.wrapper>
                    <x-filament::input type="text" wire:model="business_name" />
                </x-filament::input.wrapper>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">ফোন নম্বর</label>
                <x-filament::input.wrapper>
                    <x-filament::input type="tel" wire:model="business_number" />
                </x-filament::input.wrapper>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                    পার্টনার টাইপ (Partner Type)
                </label>

                <x-filament::input.wrapper shadow="sm">
                    <select wire:model="partner_type"
                        class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer disabled:opacity-50 dark:text-white">
                        <option value="">সিলেক্ট করুন</option>
                        <option value="shop">Shop (দোকান)</option>
                        <option value="restaurant">Restaurant (রেস্টুরেন্ট)</option>
                        <option value="pharmacy">Pharmacy (ফার্মেসি)</option>
                        <option value="grocery">Grocery (মুদি দোকান)</option>
                    </select>
                </x-filament::input.wrapper>

                @error('partner_type')
                    <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">ঠিকানা (অটো আপডেট)</label>
                <x-filament::input.wrapper>
                    <textarea id="address-display" wire:model="business_address" rows="4"
                        class="block w-full border-none bg-transparent focus:ring-0 p-2 text-sm text-gray-700"></textarea>
                </x-filament::input.wrapper>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                       শাখা
                    </label>

                    <x-filament::input.wrapper shadow="sm">
                        <select wire:model="branch"
                            class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer disabled:opacity-50 dark:text-white">
                            <option value="">সিলেক্ট করুন</option>
                            <option value="main">Main Branch</option>
                            <option value="sub">Sub Branch</option>
                        </select>
                    </x-filament::input.wrapper>

                    @error('branch')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">মোট কতটি শাখা আছে </label>
                    <x-filament::input.wrapper>
                        <x-filament::input type="text" wire:model="total_branch" />
                    </x-filament::input.wrapper>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                {{-- Logo Upload Card --}}
                <div
                    class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl hover:border-primary-500 transition-all duration-300 bg-gray-50/50 dark:bg-gray-800/50">
                    <label
                        class="absolute top-3 left-4 text-xs font-bold uppercase tracking-wider text-gray-500 italic">দোকানের
                        লোগো</label>

                    <div class="relative mt-4">
                        <div
                            class="h-24 w-24 rounded-full ring-4 ring-white dark:ring-gray-700 shadow-xl overflow-hidden bg-white flex items-center justify-center">
                            @if ($logo)
                                <img class="h-full w-full object-cover" src="{{ $logo->temporaryUrl() }}">
                            @elseif($existingLogo)
                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $existingLogo) }}">
                            @else
                                {{-- SVG Store Front Icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.651V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3.004 3.004 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .414.336.75.75.75z" />
                                </svg>
                            @endif
                        </div>

                        {{-- Edit Icon Overlay (SVG Pencil) --}}
                        <label for="logo-upload"
                            class="absolute bottom-0 right-0 bg-primary-600 p-2 rounded-full shadow-lg cursor-pointer hover:bg-primary-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-4 h-4 text-white">
                                <path
                                    d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                <path
                                    d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                            </svg>
                            <input id="logo-upload" type="file" wire:model="logo" class="hidden" />
                        </label>
                    </div>

                    <p class="mt-4 text-[10px] text-gray-500 text-center uppercase font-semibold">Square (1:1) • Max 1MB
                    </p>

                    {{-- Loading Spinner (Filament default) --}}
                    <div wire:loading wire:target="logo"
                        class="absolute inset-0 bg-white/60 dark:bg-gray-900/60 flex items-center justify-center rounded-2xl backdrop-blur-[2px] z-20">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                {{-- Banner Upload Card --}}
                <div
                    class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl hover:border-primary-500 transition-all duration-300 bg-gray-50/50 dark:bg-gray-800/50">
                    <label
                        class="absolute top-3 left-4 text-xs font-bold uppercase tracking-wider text-gray-500 italic">ব্যানার
                        ইমেজ</label>

                    <div
                        class="relative w-full mt-4 h-24 rounded-xl overflow-hidden shadow-inner bg-gray-200/50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600">
                        @if ($banner)
                            <img class="h-full w-full object-cover" src="{{ $banner->temporaryUrl() }}">
                        @elseif($existingBanner)
                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $existingBanner) }}">
                        @else
                            <div class="h-full w-full flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 opacity-50">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-[10px] mt-1 font-medium uppercase">No Banner Found</span>
                            </div>
                        @endif

                        {{-- Custom Hover Action --}}
                        <label for="banner-upload"
                            class="absolute inset-0 flex items-center justify-center bg-gray-900/40 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer backdrop-blur-[1px]">
                            <div
                                class="bg-white px-4 py-1.5 rounded-full shadow-lg text-gray-900 text-[11px] font-bold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3.5 h-3.5 text-primary-600">
                                    <path
                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                পরিবর্তন করুন
                            </div>
                            <input id="banner-upload" type="file" wire:model="banner" class="hidden" />
                        </label>
                    </div>

                    <p class="mt-4 text-[10px] text-gray-500 text-center uppercase font-semibold">Panoramic View • Max
                        2MB</p>

                    {{-- Loading Spinner (SVG) --}}
                    <div wire:loading wire:target="banner"
                        class="absolute inset-0 bg-white/60 dark:bg-gray-900/60 flex items-center justify-center rounded-2xl backdrop-blur-[2px] z-20">
                        <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3 mb-3">
                {{-- City Dropdown --}}
                <div class="space-y-2">
                    <label for="selectedCity"
                        class="text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <x-heroicon-m-map-pin class="w-4 h-4 text-primary-500" />
                        সিটি (City)
                    </label>

                    <x-filament::input.wrapper shadow="sm" border="true">
                        <select wire:model.live="selectedCity" id="selectedCity"
                            class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer disabled:opacity-50">
                            <option value="">সিটি সিলেক্ট করুন</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </x-filament::input.wrapper>
                </div>

                {{-- Zone Dropdown --}}
                <div class="space-y-2">
                    <label for="selectedZone"
                        class="text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <x-heroicon-m-map class="w-4 h-4 text-primary-500" />
                        জোন (Zone)
                    </label>

                    <x-filament::input.wrapper shadow="sm" border="true" :disabled="empty($zones)">
                        <select wire:model="selectedZone" id="selectedZone" @disabled(empty($zones))
                            class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer disabled:cursor-not-allowed">
                            <option value="">জোন সিলেক্ট করুন</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                    </x-filament::input.wrapper>

                    @if (empty($zones) && $selectedCity)
                        <p class="text-[10px] text-amber-600 animate-pulse">এই সিটির জন্য কোনো জোন পাওয়া যায়নি।</p>
                    @endif
                </div>
            </div>

            <x-filament::button wire:click="save" class="w-full" size="lg">
                সংরক্ষণ করুন
            </x-filament::button>
        </x-filament::card>

        <x-filament::card>
            <div x-data="mapComponent({
                lat: @js($latitude),
                lng: @js($longitude)
            })" x-init="initMap()" wire:ignore>
                {{-- Search Input - Model sorano hoyeche conflict thik korte --}}
                <div class="mb-2">
                    <input type="text" x-ref="searchInput" {{-- .stop dile Livewire ba Filament er sathe conflict hobe na --}}
                        @input.debounce.2000ms.stop="searchLocation($el.value)"
                        @keydown.enter.prevent.stop="searchLocation($el.value)"
                        placeholder="এলাকা সার্চ করুন (টাইপ করে ২ সেকেন্ড অপেক্ষা করুন)..."
                        class="w-full border rounded p-2 text-sm dark:bg-gray-800 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500" />

                    {{-- Loading indicator --}}
                    <template x-if="searching">
                        <div class="text-[11px] text-primary-600 mt-1 flex items-center gap-1">
                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            খোঁজা হচ্ছে...
                        </div>
                    </template>
                </div>

                <div x-ref="mapElement" id="map" style="height: 500px; border-radius: 12px; z-index: 1;"></div>
            </div>
        </x-filament::card>
    </div>

    {{-- Leaflet Scripts --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        function mapComponent(config) {
            return {
                map: null,
                marker: null,
                lat: config.lat,
                lng: config.lng,
                searching: false, // Loading state

                initMap() {
                    this.map = L.map(this.$refs.mapElement).setView([this.lat, this.lng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(this.map);

                    this.marker = L.marker([this.lat, this.lng], {
                        draggable: true
                    }).addTo(this.map);

                    this.marker.on('dragend', () => {
                        const pos = this.marker.getLatLng();
                        this.updateAll(pos.lat, pos.lng);
                    });
                },

                async searchLocation(query) {
                    if (!query || query.length < 3) return; // 3 digit er kom hole search korbe na

                    this.searching = true; // Start loading
                    try {
                        const res = await fetch(
                            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
                        const data = await res.json();

                        if (data.length > 0) {
                            const center = [data[0].lat, data[0].lon];
                            this.map.setView(center, 16);
                            this.marker.setLatLng(center);
                            this.updateAll(parseFloat(data[0].lat), parseFloat(data[0].lon), data[0].display_name);
                        }
                    } catch (error) {
                        console.error("Search error:", error);
                    } finally {
                        this.searching = false; // Stop loading
                    }
                },

                async updateAll(lat, lng, displayName = null) {
                    @this.set('latitude', lat);
                    @this.set('longitude', lng);

                    if (displayName) {
                        @this.set('business_address', displayName);
                    } else {
                        const res = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
                        const data = await res.json();
                        if (data.display_name) {
                            @this.set('business_address', data.display_name);
                        }
                    }
                }
            }
        }
    </script>
</x-filament-panels::page>
