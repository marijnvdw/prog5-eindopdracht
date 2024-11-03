<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Category;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryIds = $request->input('categories', []);  // Default to empty array if no categories are selected
        $searchTerm = $request->input('search-term');

        $query = Location::query();


        if (!auth()->check()) {
            // If not logged in, show only active locations
            $query->where('status', 1);
        } else {
            $user = auth()->user();

            if ($user->admin === 1) {
                // If admin, show all locations (no status filter needed)
            } else {
                // Check if the user has at least 3 active locations
                $hasThreeActiveLocations = $user->locations()->where('status', 1)->count() >= 3;

                if ($hasThreeActiveLocations) {
                    // Show all active locations and this user's inactive locations
                    $query->where(function ($q) use ($user) {
                        $q->where('status', 1)  // Active locations
                        ->orWhere(function ($q2) use ($user) {
                            $q2->where('status', 0)
                                ->where('user_id', $user->id);  // User's own inactive locations
                        });
                    });
                } else {
                    // If the user does not meet the criteria, show only active locations
                    $query->where('status', 1);
                }
            }
        }

        // Filter by selected categories if any are selected
        if (!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        // Filter by search term if provided
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $locations = $query->get();
        $categories = Category::all();
        return view('locations', compact('locations'), compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!request()->user()) {
            return abort(404);
        }
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!request()->user()) {
            return abort(404);
        }
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:999|min:10',
            'address' => 'required|string|max:255',
            'coordinates' => 'required|string|max:35',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('locations', 'public');  // Store in the 'locations' folder in the public disk
        } else {
            $imagePath = null;
        }

        $location = new Location();
        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->address = $request->input('address');
        $location->coordinates = $request->input('coordinates');
        $location->country = $request->input('country');
        $location->city = $request->input('city');
        $location->image = $imagePath;
        $location->category_id = $request->input('category_id');
        $location->user_id = request()->user()->id;
        $location->save();// ->error('success', 'Location added successfully!');


        return redirect()->route('locations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        $user = request()->user();

        // Check if the location is active, or the user is an admin, or the user is the creator of the location
        if (!$location->status && (!isset($user) || ($user->admin != 1 && $location->user_id != $user->id))) {
            return abort(404);
        }
        $location = Location::with('category', 'user')->findOrFail($id);
        return view('details', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!request()->user()) {
            return abort(404);
        }
        $location = Location::findOrFail($id);
        $categories = Category::all();
        if (auth()->check()) {
            if (request()->user()->admin === 1 || ($location->user_id === request()->user()->id)) {
                return view('edit_location', compact('location', 'categories'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!request()->user()) {
            return abort(404);
        }

        $location = Location::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:999|min:10',
            'address' => 'required|string|max:255',
            'coordinates' => 'required|string|max:35',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'category_id' => 'required|integer',
        ]);

        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->address = $request->input('address');
        $location->coordinates = $request->input('coordinates');
        $location->country = $request->input('country');
        $location->city = $request->input('city');
        $location->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {

            // Store the new image
            $image = $request->file('image');
            $imagePath = $image->store('locations', 'public');  // Store in the 'public/locations' folder
            $location->image = $imagePath;
        }

        $location->update();

        return redirect()->route('locations.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $user_id)
    {
        if (request()->user()->admin != 1 && $user_id != request()->user()->id) {
            return abort(404);
        }
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index');
    }

    public function toggleStatus($id)
    {
        $location = Location::findOrFail($id);

        // Toggle the status
        $location->status = !$location->status;
        $location->save();

        return redirect()->back();
    }


}
