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
    public function index()
    {
        $locations = Location::all();
        $categories = Category::all();
        return view('locations', compact('locations'), compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'coordinates' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('locations', 'public');  // Store in the 'locations' folder in the public disk
        } else {
            $imagePath = null;  // If no image is uploaded
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
        //$location->user_id = $request->input('user_id');
        $location->user_id = request()->user()->id;
        $location->save();// ->error('success', 'Location added successfully!');

        // Redirect to a page with a success message
        return redirect()->route('locations.index');//->with('success', 'Location added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
//        $location = Location::find($id);
//        return view('details', compact('location'));
        $location = Location::with('category', 'user')->findOrFail($id);  // Eager load category and user
        return view('details', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);  // Retrieve the location by ID, or fail if not found
        $categories = Category::all();  // Assuming you need categories for a dropdown
        return view('edit_location', compact('location', 'categories'));  // Pass the location and categories to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'coordinates' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Corrected validation for image
            'category_id' => 'required|exists:categories,id',
        ]);

        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->address = $request->input('address');
        $location->coordinates = $request->input('coordinates');
        $location->country = $request->input('country');
        $location->city = $request->input('city');
        $location->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
//            if ($location->image) {
//                Storage::delete('public/' . $location->image);
//            }

            // Store the new image
            $image = $request->file('image');
            $imagePath = $image->store('locations', 'public');  // Store in the 'public/locations' folder
            $location->image = $imagePath;
        }

        // Update location data
        $location->update();

        return redirect()->route('locations.index')->with('success', 'Location updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $location = Location::findOrFail($id);  // Find the location by its ID
        $location->delete();  // Delete the location

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');  // Redirect back to the list with a success message

    }


}
