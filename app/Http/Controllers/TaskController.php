<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\updateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            $tasks = Task::all();
        } else {
            $tasks = $user->tasks; // العلاقة من الموديل
        }

        return response()->json([
            'data' => $tasks
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
       
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        $task = Task::create($validatedData);
        return response()->json($task, status: 201);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
      
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validated();

        $task->update($validatedData);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

      return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    public function getTaskBypriority(request $request)
    {
        $query = Auth::user()->tasks();

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->orderByRaw("FIELD(priority,'high','medium','low')")->get();

        return response()->json($tasks, 200);
    }
    public function addToFavorite($taskId)
    {
        $user = Auth::user();

        $task = Task::findOrFail($taskId);

        $user->favorites()->attach($taskId);

        return response()->json(['message' => 'Task added to favorites successfully']);
    }



    public function removeformfavorite($taskId)
    {
        $user = Auth::user();
        $task = Task::findOrFail($taskId);

        $user->favorites()->detach($taskId);

        return response()->json([
            'message' => 'Task removed from favorites successfully',
            'task_id' => $taskId
        ], 200);
    }

    public function getTaskCategories($taskId)
    {
        $categories = Task::findOrFail($taskId)->categories;
        return response()->json($categories, status: 200);
    }
    public function getCategorieTask($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $tasks = $category->tasks;      
        return response()->json($tasks, 200);
    }
}
