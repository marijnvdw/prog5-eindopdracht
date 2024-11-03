<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->admin !== 1) {
            return abort(404);
        }
        $categories = Category::all();
        return view('admin', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->admin !== 1) {
            return abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin')->with('success', 'Category added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (!Auth::check() || Auth::user()->admin !== 1) {
            return abort(404);
        }

        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($request->id);
        $category->update($request->only('name'));

        return redirect()->route('admin')->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!Auth::check() || Auth::user()->admin !== 1) {
            return abort(404);
        }

        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        $category = Category::findOrFail($request->id);

        //change all locations linked to that category to other (id 1)
        $defaultCategoryId = 1;
        \App\Models\Location::where('category_id', $category->id)->update(['category_id' => $defaultCategoryId]);

        // Delete the category
        $category->delete();

        return redirect()->route('admin')->with('success', 'Category deleted successfully.');

    }
}
