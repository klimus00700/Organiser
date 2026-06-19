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

        $tasks = Task::with('category')
            ->where('user_id', auth()->id())
            ->orderBy('completed', 'asc')
            ->orderBy('created_at', 'desc')
        ->get();

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
        $task = new Task([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->id()
        ]);

        $task->save();

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
    public function update(Request $request, Task $task)
    {
        if ($request->has('title')) {
            $task->update(['title' => $request->input('title')]);
        }

        if ($request->has('category_id')) {
            $task->update(['category_id' => $request->input('category_id') ?: null]);
        }

        if ($request->has('completed')) {
            $task->update(['completed' => $request->boolean('completed')]);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index');
    }

    public function stats()
    {
        $user = auth()->user();

        $tasks = $user->tasks()->get();

        $total = $tasks->count();
        $completed = $tasks->where('completed', true)->count();

        // По категориям
        $categories = $tasks
            ->groupBy('category.name')
            ->map(fn($items) => $items->count());

        // Проценты
        $categoriesPercent = $categories->map(function ($count) use ($total) {
            return round(($count / $total) * 100);
        });

        // Неделя
        $weekTasks = $user->tasks()
            ->whereBetween('created_at', [now()->startOfWeek(), now()])
            ->get();

        // Месяц
        $monthTasks = $user->tasks()
            ->whereMonth('created_at', now()->month)
            ->get();

        return view('stats', [
            'categories' => $categoriesPercent,
            'weekCompleted' => $weekTasks->where('completed', true)->count(),
            'weekTotal' => $weekTasks->count(),
            'monthCompleted' => $monthTasks->where('completed', true)->count(),
            'monthTotal' => $monthTasks->count(),
        ]);
    }
}
