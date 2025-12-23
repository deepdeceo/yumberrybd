<div class="fixed inset-0 z-50 overflow-y-auto bg-slate-50">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <div class="min-h-screen flex items-center justify-center p-0 sm:p-4 md:p-8">
        <div
            class="max-w-[1100px] w-full bg-white shadow-xl sm:rounded-[40px] overflow-hidden flex flex-col md:flex-row min-h-[650px]">

            <div class="w-full md:w-[50%] p-6 py-10 sm:p-12 lg:p-16 flex flex-col justify-center order-2 md:order-1">
                <div class="mb-8 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <span class="p-2.5 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                            <span class="iconify text-white text-xl" data-icon="tabler:rocket"></span>
                        </span>
                        <h1 class="text-xl font-bold text-slate-800 tracking-tight">Partner Portal</h1>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">স্বাগতম!</h2>
                    <p class="text-slate-500 mt-2 font-medium">আপনার পার্টনার অ্যাকাউন্ট তৈরি করুন</p>
                </div>

                <form wire:submit.prevent="register" class="space-y-4 sm:space-y-5">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 ml-1">পূর্ণ নাম</label>
                        <input type="text" wire:model="data.name" name="name" required
                            class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none bg-slate-50/50">
                        @error('data.name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 ml-1">ইমেইল ঠিকানা</label>
                        <input type="email" wire:model="data.email" name="email" required
                            class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none bg-slate-50/50">
                        @error('data.email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 ml-1">পাসওয়ার্ড</label>
                        <input type="password" wire:model="data.password" name="password" required
                            class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none bg-slate-50/50">
                        @error('data.password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 ml-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                        <input type="password" wire:model="data.passwordConfirmation" name="password_confirmation"
                            placeholder="••••••••"
                            class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none bg-slate-50/50">

                        @error('data.passwordConfirmation')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all transform active:scale-[0.98] mt-2 flex justify-center items-center gap-2">
                        <span wire:loading
                            class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>
                        <span wire:loading.remove>রেজিস্ট্রেশন করুন</span>
                        <span wire:loading>প্রসেসিং হচ্ছে...</span>
                    </button>
                </form>
                <p class="mt-8 text-center text-slate-500 font-medium text-sm">
                    ইতিমধ্যে অ্যাকাউন্ট আছে?
                    <a href="/partner/login" class="text-indigo-600 font-bold hover:underline">লগইন</a>
                </p>
            </div>

            <div
                class="w-full md:w-[50%] bg-indigo-600 relative overflow-hidden p-8 sm:p-12 flex flex-col items-center justify-center text-white order-1 md:order-2 min-h-[250px] md:min-h-full">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(white 1px, transparent 0px); background-size: 20px 20px;">
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                <div x-data="{
                    active: 0,
                    slides: [
                        { title: 'স্মার্ট বিজনেস সলিউশন', icon: 'tabler:device-analytics' },
                        { title: 'সহজ পেমেন্ট সিস্টেম', icon: 'tabler:wallet' },
                        { title: 'লাইভ সাপোর্ট সুবিধা', icon: 'tabler:headset' }
                    ],
                    init() { setInterval(() => { this.active = (this.active + 1) % this.slides.length }, 4000) }
                }" class="relative z-10 w-full text-center">

                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="active === index" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="flex flex-col items-center">

                            <div
                                class="w-16 h-16 md:w-20 md:h-20 bg-white/15 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 shadow-xl border border-white/20">
                                <span class="iconify text-3xl text-white" :data-icon="slide.icon"></span>
                            </div>

                            <h3 class="text-xl md:text-2xl font-bold mb-2 leading-tight" x-text="slide.title"></h3>
                            <div class="flex gap-1.5 justify-center mt-4">
                                <template x-for="(s, i) in slides" :key="i">
                                    <div class="h-1 rounded-full transition-all duration-300"
                                        :class="active === i ? 'w-6 bg-white' : 'w-1.5 bg-white/30'"></div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</div>
