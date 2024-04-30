<?php

namespace Sfneal\CrudModelActions\Utils;

use Sfneal\Models\Actions\ResolveModelName;

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
     * @var string Message to session flash & log after a failed action
     */
    private $failMessage;

    /**
     * Response message sent on success.
     *
     * @param  string|null  $message
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
     * @param  string|null  $noun
     * @return string
     */
    protected function successNoun(string $noun = null): string
    {
        // todo: add spaces to CamelCase $nouns
        // todo: add ID
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
     * @param  string|null  $verb
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
     * @param  string|null  $message
     * @return string
     */
    protected function failMessage(string $message = null): string
    {
        // Set the message during runtime
        if (isset($message)) {
            $this->failMessage = $message;
        }

        // Return declared fail message
        if (isset($this->failMessage)) {
            return $this->failMessage;
        }

        // Return the default fail message
        else {
            return "Error! Unable to save or update the {$this->getModelShortName()}.";
        }
    }

    /**
     * Retrieve the Model class's short name (without namespace).
     *
     * @return string
     */
    private function getModelShortName(): string
    {
        return (new ResolveModelName($this->model ?? $this->modelClass, true))->execute();
    }
}
