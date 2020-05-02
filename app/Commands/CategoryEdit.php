<?php

namespace App\Commands;

use App\BaseCommands\CommandWithValidation;
use App\Category;

class CategoryEdit extends CommandWithValidation
{
    protected $signature = 'category:edit';
    protected $description = 'Edit a category';

    public function handle()
    {
        $categories = Category::pluck('title', 'id')->all();
        if (empty($categories)) {
            $this->warn('No categories found!');
            return;
        }
        $categoryTitle = $this->choice('Category', $categories);
        $newCategoryTitle = $this->askWithValidation('New title', 'min:2|max:255');

        $category = Category::find(array_search($categoryTitle, $categories));
        $category->title = $newCategoryTitle;
        $category->save();

        $this->info('Category <fg=yellow>' . $newCategoryTitle . '</> is updated.</>');
    }
}
