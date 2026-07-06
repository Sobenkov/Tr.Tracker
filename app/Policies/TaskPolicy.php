<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Пользователь может обновлять только свои задачи.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * Пользователь может удалять только свои задачи.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * Пользователь может просматривать только свои задачи.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
