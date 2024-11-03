<x-layout title="Edit Location">
    <!-- Back link -->
    <div class="mb-4">
        <a href="{{ route('locations.index') }}" class="back-link">&larr; Back to Locations</a>
    </div>

    <!-- Page Heading -->
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Location</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Location Form -->
    <form action="{{ route('locations.update', $location->id) }}" enctype="multipart/form-data" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')  <!-- Use the PUT method for updating -->

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter location name" value="{{ old('name', $location->name) }}" required>
        </div>

        <!-- Description Field -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter location description">{{ old('description', $location->description) }}</textarea>
        </div>

        <!-- Address Field -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="address" name="address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter location address" value="{{ old('address', $location->address) }}">
        </div>

        <!-- Coordinates Field -->
        <div class="mb-4">
            <label for="coordinates" class="block text-sm font-medium text-gray-700">Coordinates</label>
            <input type="text" id="coordinates" name="coordinates" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter coordinates" value="{{ old('coordinates', $location->coordinates) }}">
        </div>

        <!-- Country Field -->
        <div class="mb-4">
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <input type="text" id="country" name="country" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter country" value="{{ old('country', $location->country) }}">
        </div>

        <!-- City Field -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" id="city" name="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter city" value="{{ old('city', $location->city) }}">
        </div>

        <!-- Display Current Image -->
        @if ($location->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="w-32 h-32 rounded-lg shadow-md">
            </div>
        @endif

        <!-- Image Upload Field -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Upload New Image (Optional)</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm py-2 px-3">
        </div>

        <!-- Category Field -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category_id" name="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $location->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Update Location</button>
        </div>
    </form>

</x-layout>
