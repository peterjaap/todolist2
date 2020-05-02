<?php

namespace App\Commands;

use App\BaseCommands\CommandWithValidation;
use App\Category;
use App\Task;
use Stecman\Component\Symfony\Console\BashCompletion\Completion\CompletionAwareInterface;
use Stecman\Component\Symfony\Console\BashCompletion\CompletionContext;

class TaskAdd extends CommandWithValidation implements CompletionAwareInterface
{
    protected $signature = 'task:add {--category=}';
    protected $description = 'Add a new task';

    public function handle()
    {
        $this->alert('Add a task');
        $title = $this->askWithValidation('Title', 'min:2|max:255');
        $description = $this->ask('Description');
        $categories = Category::pluck('title', 'id')->all();
        $category = $this->option('category') ?? $this->choice('Category', $categories);

        Task::create([
            'title' => $title,
            'description' => $description,
            'category_id' => array_search($category, $categories)
        ]);

        $this->info('Task <fg=yellow>' . $title . '</> has been added.');
    }

    public function completeOptionValues($optionName, CompletionContext $context)
    {
        if ($optionName === 'category') {
            return Category::pluck('title')->all();
        }
    }

    public function completeArgumentValues($argumentName, CompletionContext $context)
    {
        return [];
    }
}
