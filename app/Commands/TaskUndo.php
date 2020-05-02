<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class TaskUndo extends Command
{
    protected $signature = 'task:undo';
    protected $description = 'Command description';

    public function handle()
    {
        $this->call('task:complete', ['--undo' => true]);
    }
}
