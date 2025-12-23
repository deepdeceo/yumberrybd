<x-filament-widgets::widget>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($this->getCards() as $card)
            <div class="flex flex-col items-center justify-center text-center p-8 bg-white dark:bg-gray-900 shadow-sm rounded-lg border border-gray-100 dark:border-gray-800 transition-all hover:shadow-xl hover:-translate-y-1">

                <div class="mb-5 flex items-center justify-center w-16 h-16 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-2xl ring-4 ring-indigo-50/50">
                    <x-filament::icon
                        :icon="$card['icon']"
                        class="h-8 w-8"
                    />
                </div>

                <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $card['title'] }}
                </h2>

                <p class="mt-3 text-gray-500 dark:text-gray-400 text-sm leading-relaxed min-h-[50px]">
                    {{ $card['desc'] }}
                </p>

                <div class="mt-6 w-full">
                    <x-filament::button
                        :href="$card['link']"
                        tag="a"
                        size="md"
                        class="w-full px-6 py-2.5 bg-[#1D3557] hover:bg-[#0a2a57] shadow-lg shadow-indigo-200 dark:shadow-none rounded-xl transition-all text-white">
                        {{ $card['button_text'] }}
                    </x-filament::button>
                </div>

            </div>
        @endforeach

    </div>
</x-filament-widgets::widget>
