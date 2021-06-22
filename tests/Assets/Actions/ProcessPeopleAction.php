<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Testing\Models\People;

class ProcessPeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return People
     */
    protected function handle(): People
    {
        // Update the People model
        $this->model->address()->update($this->request->input('data.address'));

        // Return the model
        return $this->model;
    }
}
