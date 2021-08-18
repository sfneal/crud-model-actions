<?php

namespace Sfneal\CrudModelActions\Tests\Assets\Actions;

use Illuminate\Database\Eloquent\Model;

class CreatePeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return Model
     */
    protected function handle(): Model
    {
        // Create People model
        $this->model = $this->modelClass::query()->create($this->request->input('data'));

        // Return the model
        return $this->model;
    }
}
