<x-layout title="Locations">
    <form action="{{ route('locations.index') }}" method="GET">
        <p>Filters:</p>
        <div class="flex space-x-2">
            @foreach($categories as $category)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                        {{ in_array($category->id, request()->input('categories', [])) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $category->name }}</span>
                </label>
            @endforeach
        </div>

        <!-- Search term input field (optional) -->
        <div class="mt-4">
            <input type="text" name="search-term" placeholder="Search locations..."
                   value="{{ request()->input('search-term') }}" class="border border-gray-300 rounded-md p-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-blue-700">
            Apply Filters
        </button>

        <!-- Optional: "Clear Filters" button to reset filters -->
        <a href="{{ route('locations.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded-lg mt-4 hover:bg-gray-700">
            Clear Filters
        </a>
    </form>


    <div class="flex flex-wrap -mx-4">
        @foreach($locations as $location)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-6">
                <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                    <!-- Location Image (If Available) -->
                    @if ($location->image)
                        <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}"
                             class="w-32 h-auto mb-4 rounded-lg shadow-md">
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
                    @if(Auth::user())
                        @if(Auth::user()->admin === 1 || (Auth::user()->id === $location->user_id && Auth::user()->locations()->where('status', 1)->count() >= 1))
                            <!-- Toggle Button -->
                            <button
                                class="px-4 py-2 rounded-lg {{ $location->status ? 'bg-green-500' : 'bg-gray-500' }} text-white toggle-status"
                                data-id="{{ $location->id }}"

                            >{{ $location->status ? 'Active' : 'Inactive' }}</button>
                        @endif
                    @endif

                </div>
            </div>
        @endforeach

        <!-- AJAX Script -->
        <script>
            document.querySelectorAll('.toggle-status').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-id');

                    fetch(`/items/${itemId}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                        // .then(response => response.json())
                        .then(data => {
                            // Update button text and color based on new status
                            this.classList.toggle('bg-green-500');
                            this.classList.toggle('bg-gray-500');
                            console.log(this.textContent);
                            this.textContent = this.textContent === 'Active' ? 'Inactive' : 'Active';
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>

    </div>
</x-layout>
