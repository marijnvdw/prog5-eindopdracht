<x-layout title="{{ $location->name }}">

    <!-- Back link -->
    <div style="margin-bottom: 20px;">
        <a href="{{ route('locations.index') }}" class="back-link">&larr; Back to Locations</a>
    </div>

    <!-- Main Content Wrapper with Flexbox for Left (Info) and Right (Image) Columns -->
    <div style="display: flex; align-items: flex-start; gap: 20px;">

        <!-- Location Details (Left Side) -->
        <div style="flex: 1;">
            <h1 style="font-size: 32px; color: #2c3e50; font-family: 'Arial', sans-serif; margin-bottom: 10px;">
                {{ $location->name }}
            </h1>

            <div
                style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <h2 style="font-size: 24px; color: #34495e; font-family: 'Arial', sans-serif;">Location Details</h2>
                <ul style="list-style: none; padding: 0;">
                    <li><strong>Address:</strong> {{ $location->address }}</li>
                    <li><strong>Coordinates:</strong> {{ $location->coordinates }}</li>
                    <li><strong>Country:</strong> {{ $location->country }}</li>
                    <li><strong>City:</strong> {{ $location->city }}</li>
                    <li><strong>Category:</strong> {{ $location->category->name }}</li> <!-- Display category name -->
                    <li><strong>Created by:</strong> {{ $location->user->name }}</li> <!-- Display user name -->
                </ul>
                @auth
                    @if($location->user_id === Auth::user()->id or Auth::user()->admin === 1)
                        <ul>
                            <li><strong>Created At:</strong> {{ $location->created_at->format('F j, Y, g:i a') }}</li>
                            <li><strong>Last Updated:</strong> {{ $location->updated_at->format('F j, Y, g:i a') }}</li>
                        </ul>
                        <a href="{{ route('locations.edit', $location->id) }}">Edit</a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')  <!-- Spoof the DELETE method -->

                            <button type="submit"
                                    class="mt-6 bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200">
                                Delete Location
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Location Image (Right Side) -->
        @if ($location->image)
            <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="img-small">
        @endif


    </div>

</x-layout>
