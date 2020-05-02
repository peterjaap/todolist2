<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryEditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testEditWithoutCategories()
    {
        $this->artisan('category:edit')
            ->expectsOutput('No categories found!')
            ->assertExitCode(0);
    }

    public function testEditExistingCategory()
    {
        $title = $this->faker->title;

        $this->artisan('category:add')
            ->expectsQuestion('Title', $title)
            ->expectsOutput('Category ' . $title . ' has been added.')
            ->assertExitCode(0);

        $newTitle = $this->faker->title;

        $this->artisan('category:edit')
            ->expectsChoice('Category', $title, [$title])
            ->expectsQuestion('New title', $newTitle)
            ->expectsOutput('Category ' . $newTitle . ' is updated.')
            ->assertExitCode(0);
    }
}
