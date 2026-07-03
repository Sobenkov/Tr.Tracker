<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Список только своих задач
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'in_progress',
            'time_spent_minutes' => 0,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Задача создана!');
    }

    public function edit(Task $task)
    {
        // Проверка, что задача принадлежит текущему пользователю
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->only(['title', 'description', 'status']);

        if ($request->has('add_minutes') && $request->add_minutes > 0) {
            $task->time_spent_minutes += $request->add_minutes;
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Данные обновлены!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id === auth()->id()) {
            $task->delete();
        }
        return redirect()->route('tasks.index');
    }
}
