<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">

        <div class="md:w-1/2 bg-[#f8f9fa] p-12 flex items-center justify-center relative">
            <img src="{{ asset('img/8513907_3911161.jpg') }}" alt="Food Delivery" class="w-full object-contain">
        </div>

        <div class="md:w-1/2 p-8 md:p-16 flex flex-col justify-center items-center text-center">
            <div class="mb-6">
                <div class="bg-red-600 rounded-full p-3 inline-block cursor-pointer" wire:click="setStep('options')">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign up</h2>
            <p class="text-gray-500 mb-10">
                {{ $step === 'options' ? 'Sign up into your account from here' : 'Please fill the details below' }}
            </p>

            <div class="w-full max-w-sm space-y-4">

                @if ($step === 'options')
                    <button wire:click="setStep('mobile')"
                        class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                        <svg class="w-5 h-5 text-red-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-700 font-medium">Sign up with mobile</span>
                    </button>

                    <button wire:click="setStep('email')"
                        class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span class="text-gray-700 font-medium">Sign up with Email</span>
                    </button>
                @else
                    <div class="space-y-3 animate-fade-in">
                        <input type="text" wire:model="name" placeholder="Full Name"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">

                        @if ($step === 'mobile')
                            <input type="tel" wire:model="mobile" placeholder="Mobile Number"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">
                        @else
                            <input type="email" wire:model="email" placeholder="Email Address"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">
                        @endif

                        <input type="password" wire:model="password" placeholder="Password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">

                        <button wire:click="createAccount"
                            class="w-full bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-200">
                            Create Account
                        </button>

                        <button wire:click="setStep('options')"
                            class="text-sm text-gray-500 hover:text-red-600 transition">
                            &larr; Back to options
                        </button>
                    </div>
                @endif

                @if ($step === 'options')
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="px-4 text-gray-400 text-sm">or</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <a href="/login"
                        class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div class="flex gap-1 text-sm">
                            <span class="text-gray-700 font-semibold">Sign in</span>
                            <span class="text-red-400 font-normal">(Already Registered)</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
