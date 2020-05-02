<?php

namespace App\Commands;

use App\BaseCommands\CommandWithValidation;
use App\Category;

class CategoryAdd extends CommandWithValidation
{
    protected $signature = 'category:add';
    protected $description = 'Add a new category';

    public function handle()
    {
        $this->alert('Add a category');
        $title = $this->ask('Title');

        Category::create([
            'title' => $title
        ]);

        $this->info('Category <fg=yellow>' . $title . '</> has been added.');
    }
}
