<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Cache::remember('tasks', Carbon::now()->addMinutes(30), function () {
            return Task::get();
        });
        return view('configurations.tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('configurations.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $data = [
            'ten' => $request->name,
            'mota' => $request->description,
        ];

        Task::create($data);

        return redirect()->back()->with('status', 'Task created successfully');
    }

    public function edit($taskId)
    {
        $task = Task::findOrFail($taskId);

        return view('configurations.tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $data = [
            'ten' => $request->name,
            'mota' => $request->description,
        ];

        $task->update($data);

        return redirect()->back()->with('status', 'Task Updated Successfully');
    }

    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        return redirect('/configurations/tasks')->with('status', 'Task Delete Successfully');
    }
}
