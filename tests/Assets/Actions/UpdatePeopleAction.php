<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Testing\Models\People;

class UpdatePeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return People
     */
    protected function handle(): People
    {
        // Update the People model
        $this->model->update($this->request->input('data'));

        // Return the model
        return $this->model;
    }
}
