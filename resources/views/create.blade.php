<x-layout title="Create">
    <br>
    <a href="{{ route('locations.index') }}">back</a>
    <br>


            <h1>Add New Location</h1>

             Display validation errors
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{route('locations.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter location name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter location description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter location address" value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label for="coordinates">Coordinates</label>
                    <input type="text" class="form-control" id="coordinates" name="coordinates" placeholder="Enter coordinates" value="{{ old('coordinates') }}">
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="{{ old('country') }}">
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="{{ old('city') }}">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="text" class="form-control" id="image" name="image" placeholder="Enter image" value="{{ old('image') }}">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <input type="number" class="form-control" id="category_id" name="category_id" value="{{ old('category_id') }}">
                </div>

                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="number" class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}">
                </div>

                <button type="submit" class="btn btn-primary">Add Location</button>
            </form>





</x-layout>
