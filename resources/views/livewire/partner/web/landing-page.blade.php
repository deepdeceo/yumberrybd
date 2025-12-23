<div>
    <header x-data="{ open: false, mobileOpen: false, megaOpen: false }"
        class="fixed top-0 inset-x-0 z-50 bg-white/70 backdrop-blur-xl border-b border-gray-200/50">

        <nav class="max-w-7xl mx-auto px-6">
            <div class="flex h-16 items-center justify-between">

                <!-- Logo -->
                <a href="#" class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-brand to-secondary"></div>
                    <span class="font-semibold text-lg tracking-tight text-gray-900">Yumberry</span>
                </a>

                <!-- Desktop Menu -->
                <ul class="hidden lg:flex items-center gap-8 text-sm font-medium text-gray-700">
                    <li><a href="#" class="hover:text-brand transition">Home</a></li>

                    <!-- Mega Menu -->
                    <li class="relative" @mouseenter="open = true" @mouseleave="open = false">

                        <button class="flex items-center gap-1 hover:text-brand transition">
                            Company
                            <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition x-cloak
                            class="absolute left-1/2 top-full mt-4 w-[640px] -translate-x-1/2">

                            <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 grid grid-cols-2 gap-6 p-6">

                                <!-- Left -->
                                <div class="space-y-4">
                                    <a href="#"
                                        class="group flex gap-4 rounded-xl p-3 hover:bg-gray-50 transition">
                                        <div
                                            class="h-10 w-10 rounded-lg bg-brand text-white flex items-center justify-center">
                                            ⚡
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 group-hover:text-brand">
                                                Explore Work
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Trending design inspiration
                                            </p>
                                        </div>
                                    </a>

                                    <a href="#"
                                        class="group flex gap-4 rounded-xl p-3 hover:bg-gray-50 transition">
                                        <div
                                            class="h-10 w-10 rounded-lg bg-accent text-white flex items-center justify-center">
                                            ✨
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 group-hover:text-brand">
                                                New & Noteworthy
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Emerging creators
                                            </p>
                                        </div>
                                    </a>
                                </div>

                                <!-- Right -->
                                <div class="rounded-xl bg-gray-50 p-4">
                                    <h4 class="text-xs font-semibold tracking-wider text-gray-500 uppercase">
                                        Categories
                                    </h4>
                                    <ul class="mt-4 space-y-3 text-sm">
                                        <li><a class="hover:text-brand" href="#">Animation</a></li>
                                        <li><a class="hover:text-brand" href="#">Branding</a></li>
                                        <li><a class="hover:text-brand" href="#">Illustration</a></li>
                                        <li><a class="hover:text-brand" href="#">Mobile Design</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </li>

                    <li><a href="#" class="hover:text-brand transition">Marketplace</a></li>
                    <li><a href="#" class="hover:text-brand transition">Features</a></li>
                    <li><a href="#" class="hover:text-brand transition">Team</a></li>
                </ul>

                <!-- CTA -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="#" class="text-sm text-gray-700 hover:text-brand">Log in</a>
                    <a href="#"
                        class="rounded-full bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-hover transition">
                        Get started
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded-md text-gray-700 hover:text-brand hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileOpen" x-transition
                class="lg:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-200">
                <div class="px-6 py-4 space-y-4">
                    <a href="#" class="block text-sm font-medium text-gray-700 hover:text-brand">Home</a>
                    <div>
                        <button @click="megaOpen = !megaOpen"
                            class="flex items-center gap-1 text-sm font-medium text-gray-700 hover:text-brand">
                            Company
                            <svg class="w-4 h-4 transition-transform" :class="megaOpen && 'rotate-180'"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <!-- Mobile Mega Menu -->
                        <div x-show="megaOpen" x-transition class="mt-2 space-y-2">
                            <a href="#" class="block text-sm text-gray-600 hover:text-brand">Explore Work</a>
                            <a href="#" class="block text-sm text-gray-600 hover:text-brand">New &
                                Noteworthy</a>
                            <div class="pt-2">
                                <h4 class="text-xs font-semibold text-gray-500 uppercase">Categories</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    <li><a class="text-gray-600 hover:text-brand" href="#">Animation</a></li>
                                    <li><a class="text-gray-600 hover:text-brand" href="#">Branding</a></li>
                                    <li><a class="text-gray-600 hover:text-brand" href="#">Illustration</a>
                                    </li>
                                    <li><a class="text-gray-600 hover:text-brand" href="#">Mobile Design</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="block text-sm font-medium text-gray-700 hover:text-brand">Marketplace</a>
                    <a href="#" class="block text-sm font-medium text-gray-700 hover:text-brand">Features</a>
                    <a href="#" class="block text-sm font-medium text-gray-700 hover:text-brand">Team</a>
                    <div class="pt-4 border-t border-gray-200 space-y-2">
                        <a href="#" class="block text-sm text-gray-700 hover:text-brand">Log in</a>
                        <a href="#"
                            class="block rounded-full bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-hover transition text-center">Get
                            started</a>
                    </div>
                </div>
            </div>

        </nav>
    </header>

    <section class="pt-24 md:pt-32 pb-16 md:pb-24 px-4 md:px-6 relative overflow-hidden bg-gray-50">
        <div class="max-w-7xl mx-auto relative z-10">

            <!-- Animated Badge -->
            <div class="flex justify-center mb-6 md:mb-8">
                <div x-data="{ show: false }" x-init="show = true" x-show="show"
                    x-transition.opacity.duration.700ms
                    class="inline-flex items-center gap-2 md:gap-3 bg-orange-50/80 backdrop-blur-md px-3 md:px-5 py-1.5 md:py-2 rounded-full shadow-md">
                    <span
                        class="inline-block bg-gradient-to-r from-orange-500 to-pink-500 text-white px-2 md:px-3 py-0.5 md:py-1 rounded-full text-xs font-bold animate-pulse">New!</span>
                    <span class="text-xs md:text-sm text-gray-600 font-medium">রেজিস্ট্রেশন করুন</span>
                </div>
            </div>

            <!-- Main Heading -->
            <div class="text-center max-w-2xl md:max-w-3xl mx-auto mb-6 md:mb-8">
                <h1 x-data="{ show: false }" x-init="show = true" x-show="show"
                    x-transition.opacity.duration.700ms.delay.200ms
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-4 md:mb-6 leading-tight">
                    আপনার রেস্টুরেন্টের ব্যবসা বাড়ান আমাদের <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-500">সঙ্গে</span>
                </h1>
                <p class="text-sm md:text-base lg:text-lg text-gray-600 leading-relaxed px-2 md:px-0">
                    আমাদের প্ল্যাটফর্মে যুক্ত হয়ে আরও বেশি গ্রাহকের কাছে পৌঁছান। সহজভাবে অর্ডার ম্যানেজ করুন, সময় বাঁচান
                    এবং আপনার বিক্রয় বৃদ্ধি করুন।
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-6 mb-16 md:mb-20 px-2 md:px-0">
                <a href="" wire:navigate
                    class="inline-flex items-center justify-center sm:justify-start gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 md:px-8 py-2.5 md:py-3 rounded-lg md:rounded-xl font-semibold shadow-lg hover:scale-105 transition-transform text-sm md:text-base">
                    <span class="animate-bounce">↓</span> <span class="hidden sm:inline">এবার শুরু করা যাক </span><span
                        class="sm:hidden">View Work</span>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center border-2 border-gray-900 text-gray-900 px-6 md:px-8 py-2.5 md:py-3 rounded-lg md:rounded-xl font-semibold hover:bg-gray-100 hover:scale-105 transition-transform text-sm md:text-base">
                   আরও জানুন
                </a>
            </div>

            <!-- Stats / Social Section (Optional) -->
            <div
                class="grid grid-cols-3 md:grid-cols-3 gap-4 md:gap-8 mt-12 md:mt-16 pt-8 md:pt-12 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-gray-900">500+</p>
                    <p class="text-xs md:text-sm text-gray-600 mt-1">Projects Done</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-gray-900">50+</p>
                    <p class="text-xs md:text-sm text-gray-600 mt-1">Team Members</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-gray-900">10+</p>
                    <p class="text-xs md:text-sm text-gray-600 mt-1">Years Experience</p>
                </div>
            </div>

        </div>

        <!-- Decorative Blobs / Gradient Shapes (Hide on mobile) -->
        <div
            class="hidden md:block absolute -top-32 -right-32 w-64 md:w-96 h-64 md:h-96 bg-gradient-to-tr from-blue-300 to-indigo-400 rounded-full opacity-20 md:opacity-30 blur-3xl">
        </div>
        <div
            class="hidden md:block absolute -bottom-32 -left-32 w-64 md:w-96 h-64 md:h-96 bg-gradient-to-tr from-pink-300 to-orange-400 rounded-full opacity-20 md:opacity-30 blur-3xl">
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 md:py-24 px-4 md:px-6 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-12 md:mb-16">
                <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase mb-4">Features</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                    আমাদের সাথে যুক্ত হওয়ার সুবিধা
                </h2>
                <p class="text-gray-600 text-sm md:text-base max-w-2xl mx-auto">
                    আপনার রেস্টুরেন্ট পরিচালনা সহজ এবং লাভজনক করার জন্য আমরা সর্বোত্তম সেবা প্রদান করি।
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

                <!-- Feature 1 -->
                <div class="rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 p-6 md:p-8 hover:shadow-lg transition-shadow border border-blue-100/50">
                    <div class="h-12 w-12 rounded-lg bg-blue-600 text-white flex items-center justify-center mb-4 text-xl">
                        ⚡
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">দ্রুত অর্ডার পরিচালনা</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        রিয়েল-টাইম অর্ডার ট্র্যাকিং এবং তাৎক্ষণিক নোটিফিকেশন সিস্টেম আপনার ডেলিভারি প্রক্রিয়া দ্রুততর করে।
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="rounded-2xl bg-gradient-to-br from-orange-50 to-pink-50 p-6 md:p-8 hover:shadow-lg transition-shadow border border-orange-100/50">
                    <div class="h-12 w-12 rounded-lg bg-orange-600 text-white flex items-center justify-center mb-4 text-xl">
                        👥
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">ক্রেতা সম্প্রদায়</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        হাজারো গ্রাহক প্রতিদিন আমাদের প্ল্যাটফর্মে রেস্তোরাঁ খুঁজে বের করেন এবং খাবার অর্ডার করেন।
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 p-6 md:p-8 hover:shadow-lg transition-shadow border border-green-100/50">
                    <div class="h-12 w-12 rounded-lg bg-green-600 text-white flex items-center justify-center mb-4 text-xl">
                        📊
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">বিক্রয় বৃদ্ধি</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        আমাদের মার্কেটিং টুলস এবং প্রচারণা সহায়তা আপনার বিক্রয় উল্লেখযোগ্যভাবে বৃদ্ধি করে।
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 p-6 md:p-8 hover:shadow-lg transition-shadow border border-purple-100/50">
                    <div class="h-12 w-12 rounded-lg bg-purple-600 text-white flex items-center justify-center mb-4 text-xl">
                        🛡️
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">নিরাপদ পেমেন্ট</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        আমরা সর্বোচ্চ নিরাপত্তা মান বজায় রেখে নিরাপদ পেমেন্ট প্রসেসিং নিশ্চিত করি।
                    </p>
                </div>

            </div>

        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-20 right-10 w-32 h-32 bg-blue-200 rounded-full opacity-10 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-20 left-10 w-40 h-40 bg-orange-200 rounded-full opacity-10 blur-3xl pointer-events-none"></div>
    </section>

    <!-- Best Features Section -->
    <section class="py-20 md:py-32 px-4 md:px-6 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">

            <!-- Section Header -->
            <div class="text-center mb-16 md:mb-20">
                <span class="inline-block bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase mb-4">আমাদের শক্তি</span>
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6">
                    সেরা সমাধান <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">আপনার ব্যবসার জন্য</span>
                </h2>
                <p class="text-gray-600 text-sm md:text-lg max-w-3xl mx-auto leading-relaxed">
                    আমরা প্রদান করি সম্পূর্ণ ডিজিটাল সমাধান যা আপনার রেস্টুরেন্টকে আধুনিক যুগের জন্য প্রস্তুত করে।
                </p>
            </div>

            <!-- Best Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

                <!-- Feature Card 1 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-blue-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl mb-4">
                                <span class="text-3xl">📱</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">মোবাইল অ্যাপ</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            সহজ এবং শক্তিশালী মোবাইল অ্যাপ্লিকেশন যা যেকোনো সময় যেকোনো জায়গা থেকে ব্যবহার করা যায়।
                        </p>
                        <div class="flex items-center text-blue-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature Card 2 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-pink-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-orange-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-100 to-pink-100 rounded-xl mb-4">
                                <span class="text-3xl">💳</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">পেমেন্ট সিস্টেম</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            নিরাপদ এবং দ্রুত পেমেন্ট প্রক্রিয়া সহ একাধিক পেমেন্ট গেটওয়ে সমর্থন।
                        </p>
                        <div class="flex items-center text-orange-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature Card 3 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-green-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl mb-4">
                                <span class="text-3xl">📊</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">বিশ্লেষণ ড্যাশবোর্ড</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            বিস্তারিত বিক্রয় বিশ্লেষণ এবং রিয়েল-টাইম ড্যাশবোর্ড দিয়ে ব্যবসা নিয়ন্ত্রণ করুন।
                        </p>
                        <div class="flex items-center text-green-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature Card 4 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-purple-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl mb-4">
                                <span class="text-3xl">🚚</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">ডেলিভারি ম্যানেজমেন্ট</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            স্মার্ট ডেলিভারি ম্যানেজমেন্ট সিস্টেম যা আপনার সময় এবং খরচ উভয়ই বাঁচায়।
                        </p>
                        <div class="flex items-center text-purple-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature Card 5 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-rose-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-red-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-100 to-rose-100 rounded-xl mb-4">
                                <span class="text-3xl">👨‍💼</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">স্টাফ ম্যানেজমেন্ট</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            আপনার কর্মীদের সহজে পরিচালনা করুন এবং তাদের কর্মক্ষমতা ট্র্যাক করুন।
                        </p>
                        <div class="flex items-center text-red-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature Card 6 -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-8 hover:border-cyan-200 transition-all duration-300 hover:shadow-xl">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-xl mb-4">
                                <span class="text-3xl">🎯</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">মার্কেটিং টুলস</h3>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            শক্তিশালী মার্কেটিং টুলস দিয়ে আপনার ব্যবসা প্রচার করুন এবং গ্রাহক বাড়ান।
                        </p>
                        <div class="flex items-center text-cyan-600 font-semibold group-hover:gap-2 transition-all">
                            <span>আরও জানুন</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CTA Section -->
            <div class="mt-16 md:mt-20 text-center">
                <a href="#" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 md:px-12 py-3 md:py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                    সব ফিচার দেখুন
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

        </div>

        <!-- Decorative Background -->
        <div class="absolute top-1/4 -right-32 w-96 h-96 bg-blue-200 rounded-full opacity-5 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-indigo-200 rounded-full opacity-5 blur-3xl pointer-events-none"></div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-16 md:py-24 px-4 md:px-6 border-t border-gray-200">
        <div class="max-w-7xl mx-auto">

            <!-- Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-12 mb-12">

                <!-- Brand Column -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600"></div>
                        <span class="font-bold text-lg text-gray-900">Yumberry</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        আপনার রেস্টুরেন্টের স্বপ্ন বাস্তবায়নে আমরা আপনার সঙ্গী। গ্রাহক সেবায় আমরা সর্বদা নিবেদিত।
                    </p>
                </div>

                <!-- Navigation Links -->
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">নেভিগেশন</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">হোম</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">আমাদের সেবা</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">মূল্য নির্ধারণ</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">ইভেন্ট</a></li>
                    </ul>
                </div>

                <!-- Contact Links -->
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">যোগাযোগ</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">সহায়তা</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">ডেভেলপার</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">গ্রাহক সেবা</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">শুরু করুন গাইড</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">নিউজলেটার সাবস্ক্রাইব করুন</h4>
                    <p class="text-gray-600 text-sm mb-4">আমাদের সর্বশেষ আপডেট পান আপনার ইমেইলে।</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="আপনার ইমেইল"
                            class="flex-1 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <button class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Divider -->
            <div class="border-t border-gray-300 my-8"></div>

            <!-- Footer Bottom -->
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
                <p>&copy; 2025 Yumberry. সর্বাধিকার সংরক্ষিত।</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-blue-600 transition">গোপনীয়তা নীতি</a>
                    <a href="#" class="hover:text-blue-600 transition">শর্তাবলী</a>
                    <a href="#" class="hover:text-blue-600 transition">কুকি নীতি</a>
                </div>
            </div>

        </div>
    </footer>

</div>
