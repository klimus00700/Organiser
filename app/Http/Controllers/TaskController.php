<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $tasks = Task::with('category')->orderBy('completed', 'asc')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
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
        Task::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('tasks.index');
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
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['completed' => $request->has('completed')]);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index');
    }
}
