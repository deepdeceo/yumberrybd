<div class="antialiased font-sans">
    <section class="bg-[#D1E9E3] py-12 md:py-20 px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-[#3E6553] text-3xl md:text-5xl font-bold mb-4 leading-tight">
                Fresh Item That Deserve To Eat
            </h1>
            <p class="text-[#7A9C8C] text-base md:text-lg mb-8">
                Get your groceries items delivered in less than an hour
            </p>

            <div x-data="{ search: '' }" class="relative max-w-2xl mx-auto">
                <input type="text" x-model="search" placeholder="Search for grocery or store..."
                    class="w-full py-3 md:py-4 px-6 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-200 text-gray-600 pr-12 transition-all">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-7xl mx-auto py-8 md:py-12 px-4" x-data="{
        next() {
                this.$refs.slider.scrollBy({ left: this.$refs.slider.offsetWidth / 2, behavior: 'smooth' });
            },
            prev() {
                this.$refs.slider.scrollBy({ left: -(this.$refs.slider.offsetWidth / 2), behavior: 'smooth' });
            }
    }">
        <div class="relative group">
            <div x-ref="slider" class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-6 no-scrollbar scroll-smooth"
                style="scrollbar-width: none; -ms-overflow-style: none;">

                @foreach ($subCategories as $sub)
                    <div
                        class="min-w-[140px] md:min-w-[180px] snap-start border border-gray-100 rounded-2xl p-4 flex flex-col items-center hover:shadow-xl hover:border-transparent transition-all duration-300 cursor-pointer bg-white group/card">

                        <div
                            class="bg-gray-50 w-full aspect-square rounded-xl flex items-center justify-center mb-4 transform group-hover/card:scale-110 transition-transform duration-300">
                            @if ($sub->image)
                                <img src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->name }}"
                                    class="w-12 h-12 md:w-16 md:h-16 object-contain">
                            @else
                                <img src="https://cdn-icons-png.flaticon.com/128/2329/2329865.png"
                                    class="w-12 h-12 md:w-16 md:h-16 object-contain opacity-40">
                            @endif
                        </div>

                        <span
                            class="text-[#4A5568] font-semibold text-sm md:text-base group-hover/card:text-green-600 text-center transition-colors">
                            {{ $sub->name }}
                        </span>
                    </div>
                @endforeach

            </div>

            <button @click="prev()"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow-xl rounded-full p-3 ml-[-10px] md:ml-[-20px] z-10 hidden md:group-hover:flex items-center justify-center hover:bg-green-50 hover:scale-110 transition-all focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button @click="next()"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow-xl rounded-full p-3 mr-[-10px] md:mr-[-20px] z-10 hidden md:group-hover:flex items-center justify-center hover:bg-green-50 hover:scale-110 transition-all focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

    <section class="max-w-7xl mx-auto py-12 px-4" x-data="{
        next() { this.$refs.productSlider.scrollBy({ left: 300, behavior: 'smooth' }); },
            prev() { this.$refs.productSlider.scrollBy({ left: -300, behavior: 'smooth' }); }
    }">
        <div class="flex justify-between items-end mb-6 border-b border-gray-100 pb-4 relative">
            <div>
                <h2 class="text-2xl font-bold text-[#1f4e3d]">Near you</h2>
                <div class="absolute bottom-0 left-0 w-20 h-1 bg-[#10b981]"></div>
            </div>
            <a href="#" class="text-[#10b981] font-bold hover:underline flex items-center">
                View All
            </a>
        </div>

        <div class="relative group bg-[#f3f4f6] p-6 rounded-xl">
            <div x-ref="productSlider" x-data="{ openQuickView: false, product: {} }"
                class="flex gap-5 overflow-x-auto no-scrollbar snap-x snap-mandatory">

                @foreach ($products as $show)
                    <div @click="openQuickView = true; product = {{ json_encode($show) }}; product.category_name = '{{ $show->category->name ?? 'No Category' }}'"
                        class="min-w-[240px] w-[240px] bg-white rounded-2xl p-4 snap-start relative shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="absolute top-4 left-4 bg-[#ff6b6b] text-white text-xs font-bold px-2 py-1 rounded">
                            @if ($show->discount_type === 'percent')
                                {{ $show->discount_amount }}% OFF
                            @else
                                ৳{{ $show->discount_amount }} OFF
                            @endif
                        </div>

                        <div class="h-40 flex items-center justify-center mb-4">
                            @if ($show->thumbnail)
                                {{-- \Storage::url() use kora best, eta auto 'storage/' prefix add kore --}}
                                <img src="{{ asset('storage/' . $show->thumbnail) }}" alt="{{ $show->title }}"
                                    class="h-32 object-contain">
                            @else
                                <img src="https://via.placeholder.com/150" alt="No Image"
                                    class="h-32 object-contain opacity-50">
                            @endif
                        </div>

                        <div class="space-y-1">
                            <h3 class="font-bold text-[#4b5563] text-sm line-clamp-2" title="{{ $show->title }}">
                                {{ $show->title }}
                            </h3>

                            <p class="text-xs text-gray-400">{{ $show->category->name ?? 'No Category' }}</p>
                            <div class="flex justify-between items-center pt-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-[#10b981] font-bold text-lg">
                                        BDT {{ number_format($show->final_price, 2) }}
                                    </span>

                                    {{-- Jodi discount thake, tobei ashol price-ti line-through diye dekhabe --}}
                                    @if ($show->discount_amount > 0)
                                        <span class="text-gray-400 text-sm line-through">
                                            {{ number_format($show->selling_price, 2) }}
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="bg-[#10b981] text-white text-xs font-bold px-2 py-1 rounded flex items-center gap-1">
                                    <span>★</span> 0.00
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div x-show="openQuickView" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                    x-cloak>
                    <div @click.away="openQuickView = false"
                        class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden relative shadow-2xl">
                        <button @click="openQuickView = false"
                            class="absolute top-4 right-4 text-gray-500 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="grid grid-cols-1 md:grid-cols-2 p-6 gap-6">
                            <div class="bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center p-4 relative cursor-zoom-in"
                                x-data="{ zoom: false, scale: 2, origin: 'center' }"
                                @mousemove="
        zoom = true;
        let rect = $el.getBoundingClientRect();
        let x = (($event.clientX - rect.left) / rect.width) * 100;
        let y = (($event.clientY - rect.top) / rect.height) * 100;
        origin = `${x}% ${y}%`;
    "
                                @mouseleave="zoom = false">
                                <img :src="'/storage/' + product.thumbnail" :alt="product.title"
                                    class="max-h-64 object-contain transition-transform duration-150 ease-out"
                                    :style="zoom ? `transform: scale(${scale}); transform-origin: ${origin};` :
                                        'transform: scale(1);'">
                            </div>

                            <div class="space-y-4">
                                <p class="text-sm text-green-600 font-semibold" x-text="product.category_name"></p>
                                <h2 class="text-2xl font-bold text-gray-800" x-text="product.title"></h2>

                                <div class="flex items-center gap-3">
                                    <span class="text-2xl font-bold text-[#10b981]"
                                        x-text="'BDT ' + Number(product.final_price).toLocaleString()"></span>
                                    <template x-if="product.discount_amount > 0">
                                        <span class="text-gray-400 line-through"
                                            x-text="Number(product.selling_price).toLocaleString()"></span>
                                    </template>
                                </div>

                                <p class="text-gray-500 text-sm leading-relaxed"
                                    x-text="product.description ?? 'No description available.'"></p>

                                <div class="pt-4 flex gap-2">
                                    <button
                                        class="flex-1 bg-[#10b981] text-white py-3 rounded-xl font-bold hover:bg-[#059669] transition">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button @click="prev()"
                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white shadow-lg rounded-full p-2 z-10 hidden group-hover:block transition-all hover:bg-green-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="next()"
                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white shadow-lg rounded-full p-2 z-10 hidden group-hover:block transition-all hover:bg-green-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>
