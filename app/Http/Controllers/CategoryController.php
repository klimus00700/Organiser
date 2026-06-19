<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::where('user_id', auth()->id())->get();
    return view('categories.index', compact('categories'));
}

public function store(Request $request)
{
    $category = Category::create([
        'name' => $request->name,
        'user_id' => auth()->id()
    ]);
    return response()->json($category);
}
public function destroy(Category $category)
{
    $category->delete();
    return back();
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    public function update(Request $request, Category $category)
    {
        if ($request->has('name')) {
            $category->update(['name' => $request->input('name')]);
        }

        return response()->json(['ok' => true]);
    }


}
