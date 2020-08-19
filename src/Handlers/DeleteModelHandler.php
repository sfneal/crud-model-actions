<?php


namespace Sfneal\CrudModelActions\Handlers;


use Exception;
use Illuminate\Database\Eloquent\Model;

trait DeleteModelHandler
{
    /**
     * Save or update the Model
     *
     * @return Model
     * @throws Exception
     */
    protected function handle(): Model
    {
        // Delete the Model
        $this->model->delete();

        // Return the Model
        return $this->model;
    }
}
