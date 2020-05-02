<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryAddTest extends TestCase
{
    use RefreshDatabase;

    public function testAddingACategory()
    {
        $title = 'House';

        $this->artisan('category:add')
            ->expectsQuestion('Title', $title)
            ->expectsOutput('Category ' . $title . ' has been added.')
            ->assertExitCode(0);
    }
}
