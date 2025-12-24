<div>
    <div class=" transition-colors duration-300  sm:p-16 text-center overflow-hidden relative"
        :class="darkMode ? 'bg-slate-800' : 'bg-hero-light'">

        <!-- Hero Heading -->
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight mb-4"
            :class="darkMode ? 'text-white' : ''">
            Your Everyday <span class="text-custom-green">Needs</span>,<br class="hidden sm:block">
            Delivered <span class="text-custom-green">Fast</span>
        </h1>

        <p class="text-gray-500 text-sm md:text-lg max-w-2xl mx-auto mb-12 leading-relaxed"
            :class="darkMode ? 'text-gray-400' : ''">
            Enter your address to enjoy fast delivery of groceries, food, medicine, parcels & more from your favorite
            local stores
        </p>

        <!-- Subtitle -->
        <h2 class="text-xl md:text-2xl font-extrabold text-gray-800 mb-10" :class="darkMode ? 'text-gray-200' : ''">
            Discover everything you need near you
        </h2>

        <!-- Service Category Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5 max-w-6xl mx-auto">

            <!-- Category Item Component (Alpine loop for cleaner code) -->
            <template
                x-for="category in [
                    { name: 'Grocery', icon: 'https://cdn-icons-png.flaticon.com/128/3081/3081840.png', subtitle: 'Over 14+ Stores' },
                    { name: 'Pharmacy', icon: 'https://cdn-icons-png.flaticon.com/128/3028/3028549.png', subtitle: 'Over 14+ Stores' },
                    { name: 'Shop', icon: 'https://cdn-icons-png.flaticon.com/128/3081/3081905.png', subtitle: 'Over 53+ Items' },
                    { name: 'Food', icon: 'https://cdn-icons-png.flaticon.com/128/2276/2276931.png', subtitle: 'Over 13+ Restaurants' },
                    { name: 'Parcel', icon: 'https://cdn-icons-png.flaticon.com/128/2329/2329035.png', subtitle: 'Instant Delivery' },
                    { name: 'Rental', icon: 'https://cdn-icons-png.flaticon.com/128/1048/1048313.png', subtitle: 'Over 7+ Providers' }
                ]">
                <div class="bg-white group cursor-pointer p-6 rounded-lg shadow-soft border border-transparent hover:border-green-200 transition-all duration-300 text-left relative flex flex-col items-start gap-3 hover:-translate-y-1"
                    :class="darkMode ? 'bg-slate-700 border-slate-600' : ''">

                    <!-- Icon Placeholder (In image these are colorful icons) -->
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img :src="category.icon" class="w-10 h-10 object-contain" :alt="category.name">
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-900 group-hover:text-custom-green transition-colors"
                            :class="darkMode ? 'text-white' : ''" x-text="category.name"></h3>
                        <p class="text-[10px] text-gray-400 font-medium tracking-wide uppercase mt-1"
                            x-text="category.subtitle"></p>
                    </div>

                    <!-- Arrow Icon -->
                    <div
                        class="absolute top-6 right-6 text-custom-green opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </div>
            </template>


        </div>
    </div>
    <!-- Why Choose Us Section -->
    <section class="mt-24 text-center">
        <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-3" :class="darkMode ? 'text-white' : ''">Why Choose
            Us?</h2>
        <p class="text-gray-400 font-medium mb-16">The best multi-vendor food, grocery, eCommerce, pharmacy and parcel
            delivery system.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-8 transition-transform hover:scale-110">
                    <img src="https://6am-mart-admin.6amtech.com/public/assets/admin/img/landing/fast-delivery.png"
                        class="w-12 h-12" alt="Fast"
                        onerror="this.src='https://cdn-icons-png.flaticon.com/128/411/411763.png'">
                </div>
                <h3 class="text-xl font-black mb-4" :class="darkMode ? 'text-white' : ''">Fast Delivery</h3>
                <p class="text-gray-400 text-sm px-8 leading-relaxed">Experience the fastest delivery service with our
                    dedicated team.</p>
            </div>
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-8 transition-transform hover:scale-110">
                    <img src="https://6am-mart-admin.6amtech.com/public/assets/admin/img/landing/best-quality.png"
                        class="w-12 h-12" alt="Quality"
                        onerror="this.src='https://cdn-icons-png.flaticon.com/128/3144/3144456.png'">
                </div>
                <h3 class="text-xl font-black mb-4" :class="darkMode ? 'text-white' : ''">Best Quality</h3>
                <p class="text-gray-400 text-sm px-8 leading-relaxed">We ensure the best quality of products delivered
                    right to your doorstep.</p>
            </div>
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-8 transition-transform hover:scale-110">
                    <img src="https://6am-mart-admin.6amtech.com/public/assets/admin/img/landing/safe-payment.png"
                        class="w-12 h-12" alt="Safe"
                        onerror="this.src='https://cdn-icons-png.flaticon.com/128/2910/2910768.png'">
                </div>
                <h3 class="text-xl font-black mb-4" :class="darkMode ? 'text-white' : ''">Safe Payment</h3>
                <p class="text-gray-400 text-sm px-8 leading-relaxed">Multiple secure payment options for a hassle-free
                    checkout experience.</p>
            </div>
        </div>
    </section>

    <!-- Join Us Banners (Matches Screenshot Logic) -->
    <section class="mt-24 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        <div class="bg-gray-100 rounded-[32px] p-8 flex items-center gap-6 relative overflow-hidden group cursor-pointer"
            :class="darkMode ? 'bg-slate-800' : ''">
            <div class="flex-1 z-10">
                <h3 class="text-2xl font-black mb-2">Join as Store Owner</h3>
                <p class="text-gray-500 text-sm mb-6">Register your store & grow your business with us</p>
                <button class="bg-custom-green text-white px-6 py-2.5 rounded-xl font-bold text-sm">Register
                    Now</button>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/128/869/869636.png"
                class="w-24 h-24 group-hover:scale-110 transition-transform opacity-20 md:opacity-100">
        </div>
        <div class="bg-gray-100 rounded-[32px] p-8 flex items-center gap-6 relative overflow-hidden group cursor-pointer"
            :class="darkMode ? 'bg-slate-800' : ''">
            <div class="flex-1 z-10">
                <h3 class="text-2xl font-black mb-2">Join as Deliveryman</h3>
                <p class="text-gray-500 text-sm mb-6">Register as delivery man and earn money</p>
                <button class="bg-gray-800 text-white px-6 py-2.5 rounded-xl font-bold text-sm">Register Now</button>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/128/2830/2830305.png"
                class="w-24 h-24 group-hover:scale-110 transition-transform opacity-20 md:opacity-100">
        </div>
    </section>
</div>
