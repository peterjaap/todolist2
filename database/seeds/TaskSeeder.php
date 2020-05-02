<?php

use Illuminate\Database\Seeder;
use App\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        factory(Task::class, 20)->create();
    }
}
