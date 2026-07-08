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
        $tasks = Task::owned()
            ->latest()
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
            'status' => $request->status ?? Task::STATUS_IN_PROGRESS,
            'time_spent_minutes' => 0,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Задача создана!');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->integer('add_minutes') > 0) {
            $data['time_spent_minutes'] =
                $task->time_spent_minutes + $request->integer('add_minutes');
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Данные обновлены!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function start(Task $task)
    {
        $this->authorize('update', $task);

        $task->startTimer();

        return back();
    }

    public function stop(Task $task)
    {
        $this->authorize('update', $task);

        $task->stopTimer();

        return back();
    }
}
