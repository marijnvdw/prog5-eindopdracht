<x-layout title="Locations">

    <div class="mb-4">
        <p>Filters</p>
        <div class="flex space-x-2">
            @foreach($categories as $category)
                @php
                    // Check if this category is selected by looking at the query string
                    $selectedCategories = request()->query('categories') ? explode(',', request()->query('categories')) : [];
                    $isSelected = in_array($category->id, $selectedCategories);
                @endphp

                    <!-- Button to toggle category selection -->
                <a href="{{ route('locations.index', ['categories' => toggleCategory($category->id, request()->query('categories'))]) }}"
                   class="px-4 py-2 rounded-lg {{ $isSelected ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-700' }}">
                    {{ $category->name }}
                </a>
            @endforeach

            <!-- "All" Button to Reset Filters -->
            <a href="{{ route('locations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                All
            </a>
        </div>
    </div>



    <div class="flex flex-wrap -mx-4">
        @foreach($locations as $location)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-6">
                <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                    <!-- Location Image (If Available) -->
                    @if ($location->image)
                        <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="w-32 h-auto mb-4 rounded-lg shadow-md">
                    @endif

                    <!-- Location Name -->
                    <h2 class="text-xl font-bold mb-2">
                        <a href="{{route('locations.show', $location->id)}}" class="text-blue-500 hover:text-blue-700">
                            {{$location->name}}
                        </a>
                    </h2>

                    <!-- Optional location details (e.g., address, city, etc.) -->
                    <p class="text-gray-600">
                        {{$location->city}}, {{$location->country}}
                    </p>

                    <!-- Optional created at timestamp -->
                    <p class="text-sm text-gray-500 mt-2">
                        Created at: {{ $location->created_at->format('F j, Y') }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
