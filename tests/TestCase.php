<?php

namespace Tests;

use LaravelZero\Framework\Commands\Command;
use LaravelZero\Framework\Testing\TestCase as BaseTestCase;
use Symfony\Component\Console\Tester\CommandTester;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The `CommandTester` is directly returned, use methods like
     * `->getDisplay()` or `->getStatusCode()` on it.
     *
     * @param Command $command
     * @param array $arguments The command line arguments, array of key=>value
     *   Examples:
     *   - named  arguments: ['model' => 'Post']
     *   - boolean flags: ['--all' => true]
     *   - arguments with values: ['--arg' => 'value']
     * @param array $interactiveInput Interactive responses to the command
     *   I.e. anything the command `->ask()` or `->confirm()`, etc.
     * @return CommandTester
     */
    protected function runCommand(Command $command, array $arguments = [], array $interactiveInput = []): CommandTester
    {
        $command->setLaravel($this->app);

        $tester = new CommandTester($command);
        $tester->setInputs($interactiveInput);

        $tester->execute($arguments);

        return $tester;
    }
}
