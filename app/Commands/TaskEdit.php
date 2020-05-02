<?php

namespace App\Commands;

use App\BaseCommands\CommandWithValidation;
use App\Task;

class TaskEdit extends CommandWithValidation
{
    protected $signature = 'task:edit';
    protected $description = 'Edit a task';

    public function handle()
    {
        $tasks = Task::pluck('title', 'id')->all();
        if (empty($tasks)) {
            $this->warn('No tasks found!');
            return;
        }
        $taskTitle = $this->choice('Task', $tasks);
        $newTaskTitle = $this->askWithValidation('New title', 'min:2|max:255');
        $newDescription = $this->ask('New description');

        $task = Task::find(array_search($taskTitle, $tasks));
        $task->title = $newTaskTitle;
        $task->description = $newDescription;
        $task->save();

        $this->info('Task <fg=yellow>' . $newTaskTitle . '</> is updated</>');
    }
}
