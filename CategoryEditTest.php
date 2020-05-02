<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryEditTest extends TestCase
{
//    use RefreshDatabase;

    public function testEditWithoutCategories()
    {
        $this->artisan('category:edit')
            ->expectsOutput('No categories found!')
            ->assertExitCode(0);
    }

    public function testEditExistingCategory()
    {
        $title = 'House';
        $newTitle = 'Full House';

        $this->artisan('category:add')
            ->expectsQuestion('Title', $title);

        $this->artisan('category:edit')
            ->expectsQuestion('Category', $title)
            ->expectsQuestion('New title', $newTitle)
            ->expectsOutput('Category ' . $newTitle . ' is updated')
            ->assertExitCode(0);
    }
}
