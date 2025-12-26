<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">

        <div class="md:w-1/2 bg-[#f8f9fa] p-12 flex items-center justify-center relative">
            <img src="{{ asset('img/8513907_3911161.jpg') }}" alt="Food Delivery" class="w-full object-contain">
        </div>

        <div class="md:w-1/2 p-8 md:p-16 flex flex-col justify-center items-center text-center">
            <div class="mb-6">
                <div class="bg-red-600 rounded-full p-3 inline-block cursor-pointer">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign in</h2>
            <p class="text-gray-500 mb-10">Sign in to your account</p>

            <div class="w-full max-w-sm space-y-4">
                <form wire:submit="login" class="space-y-3">
                    <input type="text" wire:model="identifier" placeholder="Email or Phone"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">

                    <input type="password" wire:model="password" placeholder="Password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 outline-none">

                    @error('login')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                    <button type="submit"
                        class="w-full bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg shadow-red-200">
                        Sign In
                    </button>
                </form>

                <div class="flex items-center my-6">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="px-4 text-gray-400 text-sm">or</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <a href="/register"
                    class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div class="flex gap-1 text-sm">
                        <span class="text-gray-700 font-semibold">Sign up</span>
                        <span class="text-red-400 font-normal">(New User)</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
