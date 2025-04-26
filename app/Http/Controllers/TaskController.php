<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // we fetch all the task from the database
        $tasks = Task::all();

        // Return the tasks view, passing tasks to it
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'task' => 'required|max:255',
        ]);

        // Create a new task and save it to the database
        Task::create([
            'task' => $request->input('task'),
        ]);

        // Redirect back to the task list
        return redirect('/tasks');
    }

    public function destroy($id)
   {
    $task = Task::findOrFail($id);
    $task->delete();

    return response()->json(['message' => 'Task deleted successfully']);
   }

}