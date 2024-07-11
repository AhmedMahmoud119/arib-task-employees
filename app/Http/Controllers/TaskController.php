<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::myTasks()->when(request()->name, function ($q, $search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->when(request()->status, function ($q, $search) {
            $q->where('status', $search);
        })->paginate(10);
        $statuses = Task::statuses();

        return view('task.index', compact('tasks', 'statuses'));
    }

    public function create()
    {
        $employees = User::myEmployees()->orderBy('id', 'desc')->get();
        $statuses = Task::statuses();

        return view('task.create', compact('employees', 'statuses'));
    }

    public function store(TaskRequest $request)
    {
        Task::create($request->all() + ['created_user_id' => auth()->user()->id]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $employees = User::myEmployees()->orderBy('id', 'desc')->get();
        $statuses = Task::statuses();

        return view('task.edit', compact('employees', 'statuses', 'task'));
    }


    public function update(Task $task, TaskRequest $request)
    {
        $this->authorize('update', $task);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function changeStatus(Task $task, Request $request)
    {
        $this->authorize('updateStatus', $task);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }
}
