<?php

namespace App\Commands;

use App\Task;
use LaravelZero\Framework\Commands\Command;

class TaskDelete extends Command
{
    protected $signature = 'task:delete';
    protected $description = 'Delete a task';

    public function handle()
    {
        $tasks = Task::pluck('title', 'id')->all();
        if (empty($tasks)) {
            $this->warn('No tasks found!');
            return;
        }
        $taskTitle = $this->choice('Task', $tasks);

        $task = Task::find(array_search($taskTitle, $tasks));
        $task->delete();

        $this->info('Task <fg=yellow>' . $taskTitle . '</> is deleted');
    }
}
