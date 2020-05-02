<?php

namespace App\BaseCommands;

use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator as Validator;
use LaravelZero\Framework\Commands\Command;

/**
 * Class CommandWithValidation
 * @package App\Commands
 */
class CommandWithValidation extends Command
{
    protected $name = 'command:with:validation';

    /**
     * Prompt the user for input.
     *
     * @param  string  $question
     * @param  array|string|null  $validationRule
     * @param  string|null  $default
     * @return mixed
     */
    public function askWithValidation($question, $validationRule = null, $default = null)
    {
        $validator = null;
        if ($validationRule) {
            if (! class_exists(Validator::class) || ! $this->app->bound('validator')) {
                throw new \RuntimeException('The "illuminate/validation" package is required to use validation rules');
            }

            $validator = function ($answer) use ($question, $validationRule) {
                ValidatorFacade::make([$question => $answer], [
                    $question => $validationRule,
                ])->validate();

                return $answer;
            };
        }

        return $this->output->ask($question, $default, $validator);
    }
}
