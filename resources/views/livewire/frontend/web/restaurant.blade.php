<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">Nearby Restaurants</h1>

    @if ($restaurants->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($restaurants as $restaurant)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        @if ($restaurant->logo)
                            <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->business_name }}" class="w-16 h-16 rounded-full mr-4">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-gray-500 text-xl">{{ substr($restaurant->business_name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-xl font-semibold">{{ $restaurant->business_name }}</h3>
                            <p class="text-gray-600">{{ $restaurant->business_address }}</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">
                            <strong>Cuisines:</strong> {{ is_array($restaurant->cuisines) ? implode(', ', $restaurant->cuisines) : $restaurant->cuisines }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Minimum Order:</strong> ${{ $restaurant->minimum_order }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Status:</strong>
                            <span class="inline-block px-2 py-1 rounded-full text-xs {{ $restaurant->is_open ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $restaurant->is_open ? 'Open' : 'Closed' }}
                            </span>
                        </p>
                        @if ($restaurant->avg_preparation_time)
                            <p class="text-sm text-gray-600">
                                <strong>Avg. Prep Time:</strong> {{ $restaurant->avg_preparation_time }} mins
                            </p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-colors">
                            View Menu
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">🍽️</div>
            <h2 class="text-2xl font-semibold text-gray-600 mb-2">No Restaurants Found</h2>
            <p class="text-gray-500">Sorry, no restaurants are available in your area right now.</p>
            @if (!$zoneId)
                <p class="text-sm text-gray-400 mt-2">Try refreshing or checking your location settings.</p>
            @endif
        </div>
    @endif
</div>
