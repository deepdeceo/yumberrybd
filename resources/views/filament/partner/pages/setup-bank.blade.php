<x-filament-panels::page>
    <form wire:submit.prevent="save">
        <div class="max-w-6xl mx-auto space-y-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

            {{-- প্রথম কার্ড: মেথড এবং টাইম টাইপ --}}
            <x-filament::card>
                {{-- পেমেন্ট টাইম টাইপ (Schedule) --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-200">
                        পেমেন্ট গ্রহণের সময় (Schedule)
                    </label>
                    <x-filament::input.wrapper shadow="sm">
                        <select wire:model.live="time_type"
                            class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer dark:text-white dark:bg-gray-800">
                            <option value="">নির্বাচন করুন</option>
                            <option value="weekly">Weekly (সাপ্তাহিক)</option>
                            <option value="day">Daily (প্রতিদিন)</option>
                            <option value="cash_on_delivery">Cash On Delivery</option>
                        </select>
                    </x-filament::input.wrapper>
                    @error('time_type')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- পেমেন্ট মেথড (শুধুমাত্র cash_on_delivery না হলে দেখাবে) --}}
                @if (($time_type ?? '') !== 'cash_on_delivery' && ($time_type ?? '') !== '')
                    <div x-transition class="mt-4">
                        <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-200">
                            পেমেন্ট মেথড (Payment Method)
                        </label>
                        <x-filament::input.wrapper shadow="sm">
                            <select wire:model.live="payment_method"
                                class="block w-full border-none bg-transparent py-2.5 ps-3 pe-10 text-sm focus:ring-0 cursor-pointer dark:text-white dark:bg-gray-800">
                                <option value="">নির্বাচন করুন</option>
                                <option value="bkash">bKash (বিকাশ)</option>
                                <option value="bank">Bank Account (ব্যাংক অ্যাকাউন্ট)</option>
                            </select>
                        </x-filament::input.wrapper>
                        @error('payment_method')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </x-filament::card>

            {{-- ব্যাংক ডিটেইলস কার্ড --}}
            @if ($payment_method === 'bank' && $time_type !== 'cash_on_delivery')
                <x-filament::card x-transition class="h-full">
                    <div class="flex items-center gap-2 mb-6 border-b pb-3">
                        <x-filament::icon icon="heroicon-o-building-library" class="h-6 w-6 text-primary-500" />
                        <h3 class="text-lg font-bold">Bank Account Details</h3>
                    </div>
                    {{-- ব্যাংকের ইনপুট ফিল্ডগুলো এখানে থাকবে --}}
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">ব্যাংকের নাম</label>
                            <x-filament::input.wrapper>
                                <x-filament::input type="text" wire:model="bank_name" placeholder="যেমন: ডাচ-বাংলা ব্যাংক" />
                            </x-filament::input.wrapper>
                        </div>
                        {{-- ... বাকি ইনপুটগুলো ... --}}
                    </div>
                </x-filament::card>
            @endif

            {{-- বিকাশ ডিটেইলস কার্ড --}}
            @if ($payment_method === 'bkash' && $time_type !== 'cash_on_delivery')
                <x-filament::card x-transition class="h-full">
                    <div class="flex items-center gap-2 mb-6 border-b pb-3">
                        <x-filament::icon icon="heroicon-o-phone-arrow-up-right" class="h-6 w-6 text-pink-500" />
                        <h3 class="text-lg font-bold">bKash Account Details</h3>
                    </div>
                    {{-- বিকাশের ইনপুট ফিল্ড --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">বিকাশ পার্সোনাল নম্বর</label>
                        <x-filament::input.wrapper>
                            <x-filament::input type="text" wire:model="bkash_number" placeholder="01XXXXXXXXX" />
                        </x-filament::input.wrapper>
                    </div>
                </x-filament::card>
            @endif

            {{-- Cash on Delivery এর জন্য ইনফো কার্ড (ঐচ্ছিক) --}}
            @if ($time_type === 'cash_on_delivery')
                <x-filament::card x-transition>
                    <div class="flex items-center gap-3 text-primary-600">
                        <x-filament::icon icon="heroicon-o-truck" class="h-8 w-8" />
                        <div>
                            <p class="font-bold">Cash On Delivery Selected</p>
                            <p class="text-xs">আপনি সরাসরি Rider কাছ থেকে টাকা সংগ্রহ করবেন। কোনো ব্যাংক ডিটেইলস প্রয়োজন নেই।</p>
                        </div>
                    </div>
                </x-filament::card>
            @endif
        </div>

        {{-- সেভ বাটন লজিক: মেথড সিলেক্ট থাকলে অথবা COD সিলেক্ট থাকলে দেখাবে --}}
        @if ($payment_method || $time_type === 'cash_on_delivery')
            <div class="flex justify-end pt-6 max-w-6xl mx-auto">
                <x-filament::button type="submit" size="lg" icon="heroicon-m-check" class="shadow-md"
                    wire:loading.attr="disabled" wire:target="save">

                    <span wire:loading.remove wire:target="save">
                        Save Settings
                    </span>

                    <span wire:loading wire:target="save">
                        Processing...
                    </span>
                </x-filament::button>
            </div>
        @endif
    </form>
</x-filament-panels::page>
