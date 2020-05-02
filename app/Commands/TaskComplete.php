<?php

namespace App\Commands;

use App\Category;
use App\Task;
use LaravelZero\Framework\Commands\Command;

class TaskComplete extends Command
{
    protected $signature = 'task:complete {--undo}';
    protected $description = 'Complete a task';

    public function handle()
    {
        $tasks = Task::where('done', $this->option('undo'))->pluck('title', 'id')->all();
        if (empty($tasks)) {
            $this->warn('No tasks left to ' . ($this->option('undo') ? 'undo' : 'do') . '!');
            return;
        }

        $categories = Category::pluck('title', 'id')->all();
        foreach ($categories as $categoryId => $category) {
            $options[$category] = Task::where('done', $this->option('undo'))->where('category_id', $categoryId)->pluck('title', 'id')->all();
        }
        $taskId = $this->menu('Select from category', $options)->open();

        if (!$taskId) {
            return;
        }

        $task = Task::find($taskId);
        $task->done = !$this->option('undo');
        $task->save();

        $this->info('Task <fg=yellow>' . $task->title . '</> is ' . ($this->option('undo') ? 'undone' : 'completed'));
    }
}
