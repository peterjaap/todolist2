<?php

namespace App\Commands;

use App\Category;
use LaravelZero\Framework\Commands\Command;

class CategoryDelete extends Command
{
    protected $signature = 'category:delete';
    protected $description = 'Delete a category';

    public function handle()
    {
        $categories = Category::pluck('title', 'id')->all();
        if (empty($categories)) {
            $this->warn('No categories found!');
            return;
        }
        $categoryTitle = $this->choice('Category', $categories);

        $category = Category::find(array_search($categoryTitle, $categories));
        $category->delete();

        $this->info('Category <fg=yellow>' . $categoryTitle . '</> is deleted');
    }
}
