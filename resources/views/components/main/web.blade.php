<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false, langOpen: false, categoryOpen: false }">

<head>
  <x-head :title="$title ?? null" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }

        .custom-green {
            color: #039D55;
        }

        .bg-custom-green {
            background-color: #039D55;
        }

        .bg-hero-light {
            background-color: #F8FBF9;
        }

        .shadow-soft {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        /* Specific input focus styling */
        .address-input:focus-within {
            border-color: #039D55;
            box-shadow: 0 0 0 3px rgba(3, 157, 85, 0.1);
        }

        .footer-dark {
            background-color: #1a202c;
        }
    </style>

</head>

<body class="bg-gray-50 text-gray-800 transition-colors duration-300" :class="darkMode ? 'bg-slate-900 text-white' : ''">

    <!-- Top Navigation Bar -->
    <div class="border-b bg-white transition-colors duration-300"
        :class="darkMode ? 'bg-slate-800 border-slate-700 text-gray-300' : 'text-gray-600'">
        <div class="max-w-[1400px] mx-auto px-4 h-10 flex justify-between items-center text-xs sm:text-sm">
            <div x-data="{
                address: 'Locating...',
                loading: true,

                async init() {
                    const savedAddr = sessionStorage.getItem('user-address');

                    if (savedAddr) {
                        this.address = savedAddr;
                        this.loading = false;
                    } else {
                        this.getLocation();
                    }
                },

                getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => this.reverseGeocode(position.coords.latitude, position.coords.longitude),
                            (error) => {
                                this.address = 'Location Access Denied';
                                this.loading = false;
                            }
                        );
                    } else {
                        this.address = 'Geolocation not supported';
                        this.loading = false;
                    }
                },

                async reverseGeocode(lat, lon) {
                    try {
                        // OpenStreetMap Nominatim API Call
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
                        const data = await response.json();

                        // Pura address theke proyojoniyo part tuku neya (e.g., City or Road)
                        // data.display_name e pura thikana thake
                        const formattedAddress = data.address.city || data.address.town || data.address.suburb || 'Rajshahi, BD';

                        this.address = formattedAddress;
                        this.loading = false;

                        // Session-e set kore rakha
                        sessionStorage.setItem('user-address', formattedAddress);
                    } catch (error) {
                        this.address = 'Error fetching address';
                        this.loading = false;
                    }
                }
            }">
                <div class="flex items-center gap-2 cursor-pointer hover:text-green-600">
                    <i class="fas fa-map-marker-alt text-green-500" :class="loading ? 'animate-pulse' : ''"></i>

                    <span class="truncate max-w-[150px] sm:max-w-none" x-text="address">
                    </span>

                    <i class="fas fa-chevron-down text-[10px]"></i>
                </div>
            </div>

            <!-- Right Side: Utilities -->
            <div class="flex items-center gap-4 sm:gap-6">
                <!-- Theme Toggle -->
                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline">Light Mode</span>
                    <button @click="darkMode = !darkMode"
                        class="w-9 h-5 rounded-full p-1 transition-colors duration-300 relative"
                        :class="darkMode ? 'bg-green-500' : 'bg-gray-300'">
                        <div class="bg-white w-3 h-3 rounded-full shadow-sm transition-transform duration-300 transform"
                            :class="darkMode ? 'translate-x-4' : 'translate-x-0'"></div>
                    </button>
                </div>

                <!-- Phone -->
                <div class="hidden md:flex items-center gap-2">
                    <i class="fas fa-phone-alt"></i>
                    <span>01700000000</span>
                </div>

                <!-- Language Selector -->
                <div class="relative" @click.away="langOpen = false">
                    <button @click="langOpen = !langOpen" class="flex items-center gap-2 hover:text-green-600">
                        <img src="https://flagcdn.com/w20/us.png" class="w-4 h-3 object-cover rounded-sm"
                            alt="EN">
                        <span>English</span>
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                    <!-- Dropdown -->
                    <div x-show="langOpen"
                        class="absolute right-0 mt-2 w-32 bg-white shadow-xl rounded-md py-2 z-50 text-gray-800 border">
                        <a href="#" class="block px-4 py-2 hover:bg-green-50">English</a>
                        <a href="#" class="block px-4 py-2 hover:bg-green-50">Bengali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white sticky top-0 z-40 shadow-sm transition-colors duration-300"
        :class="darkMode ? 'bg-slate-800 border-b border-slate-700' : ''">
        <div class="max-w-[1400px] mx-auto px-4 h-20 flex justify-between items-center">
            <!-- Brand Logo -->
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="bg-custom-green p-1.5 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-custom-green">6amMart</span>
                </div>

                <!-- Menu Links -->
                <div class="hidden lg:flex items-center gap-8 font-medium"
                    :class="darkMode ? 'text-gray-200' : 'text-gray-700'">
                    <a href="{{route('home')}}" wire:navigate class="text-custom-green border-b-2 border-custom-green pb-1">Home</a>
                    <div class="relative group">
                        <button class="hover:text-custom-green flex items-center gap-1">
                            Categories <i class="fas fa-chevron-down text-[10px]"></i>
                        </button>
                    </div>
                    <div class="relative group">
                        <button class="hover:text-custom-green flex items-center gap-1">
                            Stores <i class="fas fa-chevron-down text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Icons -->
            <div class="flex items-center gap-3 sm:gap-5">
                <button class="p-2.5 rounded-full hover:bg-gray-100 transition-colors"
                    :class="darkMode ? 'hover:bg-slate-700 text-gray-300' : 'text-gray-500'">
                    <i class="far fa-file-alt text-xl"></i>
                </button>
                <div class="relative">
                    <button class="p-2.5 rounded-full hover:bg-gray-100 transition-colors"
                        :class="darkMode ? 'hover:bg-slate-700 text-gray-300' : 'text-gray-500'">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </button>
                    <span
                        class="absolute top-1 right-1 bg-custom-green text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center border-2 border-white">0</span>
                </div>
                <button
                    class="bg-custom-green hover:bg-green-700 text-white px-5 sm:px-7 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-lg shadow-green-200/50 transition-all active:scale-95">
                    <i class="fas fa-sign-in-alt"></i>
                    <span class="hidden sm:inline">Sign In</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-[1400px] mx-auto ">
        {{ $slot }}
    </main>

    <!-- Floating Messenger Icon (Like in the image) -->
    <div class="fixed bottom-8 right-8 z-50">
        <button
            class="bg-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform">
            <img src="https://cdn-icons-png.flaticon.com/128/5968/5968771.png" class="w-8 h-8" alt="Messenger">
        </button>
    </div>


    <!-- Footer (Same to Same Design) -->
    <footer class="footer-dark text-white pt-20 pb-8 mt-24">
        <div
            class="max-w-[1400px] mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 border-b border-gray-800 pb-16">
            <!-- Brand & App Links -->
            <div class="space-y-8">
                <a href="{{route('home')}}" class="flex items-center gap-2">
                    <div class="bg-custom-green w-10 h-10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-basket text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase">Yumberry</span>
                </a>
                <div class="space-y-4">
                    <h5 class="text-sm font-bold uppercase tracking-widest text-gray-500">Download our app</h5>
                    <div class="flex flex-wrap gap-3">
                        <a href="#"
                            class="bg-gray-800 px-4 py-2 rounded-lg flex items-center gap-3 hover:bg-gray-700 transition-colors border border-gray-700 w-44">
                            <i class="fab fa-apple text-2xl"></i>
                            <div class="leading-none">
                                <span class="text-[10px] block opacity-60">Download on the</span>
                                <span class="text-sm font-bold">App Store</span>
                            </div>
                        </a>
                        <a href="#"
                            class="bg-gray-800 px-4 py-2 rounded-lg flex items-center gap-3 hover:bg-gray-700 transition-colors border border-gray-700 w-44">
                            <i class="fab fa-google-play text-xl"></i>
                            <div class="leading-none">
                                <span class="text-[10px] block opacity-60">Get it on</span>
                                <span class="text-sm font-bold">Google Play</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Useful Links -->
            <div>
                <h4 class="text-lg font-black mb-8">Useful Links</h4>
                <ul class="space-y-4 text-sm font-medium text-gray-400">
                    <li><a href="#" class="hover:text-custom-green transition-colors">Become a Store Owner</a>
                    </li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">Become a Deliveryman</a>
                    </li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">Help & Support</a></li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-black mb-8">Quick Links</h4>
                <ul class="space-y-4 text-sm font-medium text-gray-400">
                    <li><a href="#" class="hover:text-custom-green transition-colors">Loyalty Points</a></li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">My Wallet</a></li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">Refer & Earn</a></li>
                    <li><a href="#" class="hover:text-custom-green transition-colors">Terms & Conditions</a>
                    </li>
                </ul>
            </div>

            <!-- News Letter & Social -->
            <div class="space-y-8">
                <div>
                    <h4 class="text-lg font-black mb-6">Newsletter</h4>
                    <p class="text-sm text-gray-400 mb-6">Subscribe to our newsletter to get latest updates.</p>
                    <div class="relative flex">
                        <input type="email" placeholder="Email Address"
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-xl py-4 px-5 focus:ring-1 focus:ring-custom-green outline-none text-white text-sm">
                        <button
                            class="absolute right-2 top-2 bg-custom-green text-white w-10 h-10 rounded-lg flex items-center justify-center hover:bg-green-700 shadow-lg">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar (Same to Same) -->
        <div class="max-w-[1400px] mx-auto px-6 mt-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-10">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">© 2024 6AMMART. ALL RIGHTS RESERVED.
                </p>
                <div class="hidden md:flex gap-4">
                    <a href="#"
                        class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-custom-green transition-colors">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-custom-green transition-colors">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-custom-green transition-colors">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-custom-green transition-colors">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4 opacity-50">
                <img src="https://cdn-icons-png.flaticon.com/128/196/196037.png" class="h-6" alt="Visa">
                <img src="https://cdn-icons-png.flaticon.com/128/196/196059.png" class="h-6" alt="MasterCard">
                <img src="https://cdn-icons-png.flaticon.com/128/196/196066.png" class="h-6" alt="Paypal">
            </div>
        </div>
    </footer>
    @livewireScripts

</body>

</html>
