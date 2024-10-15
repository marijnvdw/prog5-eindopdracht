<?php

namespace App\Http\Controllers;
use App\Models\Location;

class LocationController extends Controller
{
    public function show()
    {
        // Fetch all locations from the database
        //$locations = Location::all(); find(1)
        $locations = Location::all();

        // Return the locations as a JSON response (or pass to a view if necessary)
        //return response()->json($locations);
        //return view('locations', ['locations' => $locations]);
        return view('locations', compact('locations'));


    }
}
