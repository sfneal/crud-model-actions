<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Illuminate\Database\Eloquent\Model;

class UpdatePeopleAction extends PeopleAction
{
    /**
     * Save or update the Model.
     *
     * @return Model
     */
    protected function handle(): Model
    {
        // Update the People model
        $this->model->update($this->request->input('data'));

        // Return the model
        return $this->model;
    }
}
