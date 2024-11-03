<x-layout title="Admin - Manage Categories">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('locations.index') }}" class="back-link">&larr; Back to Locations</a>
    </div>
    <div class="container">
        <h1>Manage Categories</h1><br>

        <!-- Display Error or Success Messages -->
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add New Category Form -->
        <h2>Add New Category</h2>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Add Category</button>
        </form>
        <br>
        <!-- List of Categories with Edit and Delete Options -->
        <h2 class="mt-5">Edit or Delete Categories</h2>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>Name</th>
                <th>New Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- Edit Category Form -->
                        <form action="{{ route('admin.update') }}" method="POST" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <input type="text" name="name" value="{{ $category->name }}" required>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>

                        <!-- Delete Category Form -->
                        <form action="{{ route('admin.destroy') }}" method="POST" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
