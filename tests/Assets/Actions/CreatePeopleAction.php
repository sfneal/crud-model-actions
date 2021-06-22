<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Sfneal\Testing\Models\People;

class CreatePeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return People
     */
    protected function handle(): People
    {
        // Create People model
        $this->model = $this->modelClass::query()->create($this->request->input('data'));

        // Return the model
        return $this->model;
    }
}
