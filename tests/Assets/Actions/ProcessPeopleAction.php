<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Illuminate\Database\Eloquent\Model;

class ProcessPeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return Model
     */
    protected function handle(): Model
    {
        // Update the People model
        $this->model->address()->update($this->request->input('data.address'));

        // Return the model
        return $this->model;
    }
}
