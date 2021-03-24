<?php

namespace Sfneal\CrudModelActions\Utils;

use Sfneal\Helpers\Laravel\LaravelHelpers;

trait ResponseMessages
{
    /**
     * @var string Verb used to describe the action performed on the model (created, updated, etc.
     */
    private $successActionVerb;

    /**
     * @var string Message to session flash & log after a successful action
     */
    private $successMessage;

    /**
     * @var string Object which was manipulated (Client, Project, Task, etc...)
     */
    private $successNoun;

    /**
     * Response message sent on success.
     *
     * @param string|null $message
     * @return string
     */
    protected function successMessage(string $message = null): string
    {
        // Set the message during runtime
        if (isset($message)) {
            $this->successMessage = $message;
        }

        // Return declared success message
        if (isset($this->successMessage)) {
            return $this->successMessage;
        }

        // Return the default success message
        else {
            return "{$this->successNoun()} has been {$this->successActionVerb()} successfully.";
        }
    }

    /**
     * Retrieve the 'noun' to be used as the object of the success message.
     *
     * @param string|null $noun
     * @return string
     */
    protected function successNoun(string $noun = null): string
    {
        // todo: add spaces to CamelCase $nouns
        // Set the success noun if passed
        if (isset($noun)) {
            $this->successNoun = $noun;
        }

        // Return the declared success noun or use default
        return $this->successNoun ?? $this->getModelShortName();
    }

    /**
     * Action verb to be used in to the success message.
     *
     * @param string|null $verb
     * @return string
     */
    protected function successActionVerb(string $verb = null): string
    {
        if (isset($verb)) {
            $this->successActionVerb = $verb;
        }

        return strtolower($this->successActionVerb ?? $this->model->mostRecentChange());
    }

    /**
     * Response message sent on failure.
     *
     * @return string
     */
    protected function failMessage(): string
    {
        $model = strtolower($this->getModelShortName());

        return "Error! Unable to save or update the {$model}.";
    }

    /**
     * Retrieve the Model class's short name (without namespace).
     *
     * @return string
     */
    private function getModelShortName(): string
    {
        // Convert table name to a CamelCase string for consistency with Model names
        $tableCamelCase = implode(
            '',
            array_map(
                function (string $piece) {
                    return ucfirst($piece);
                },
                explode('_', $this->model->getTable())
            )
        );

        // Get the $shortName from the Model's class name or the table name
        $shortName = LaravelHelpers::getClassName(
            $this->model,
            true,
            $tableCamelCase
        );

        // Split string on upper case characters
        return implode(' ', preg_split('/(?=[A-Z])/', $shortName, -1, PREG_SPLIT_NO_EMPTY));
    }
}
