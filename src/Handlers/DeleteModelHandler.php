<?php

namespace Sfneal\CrudModelActions\Handlers;

use Exception;
use Illuminate\Database\Eloquent\Model as EloquentModel;

trait DeleteModelHandler
{
    /**
     * Save or update the Model.
     *
     * @return EloquentModel
     * @throws Exception
     */
    protected function handle(): EloquentModel
    {
        // Delete the Model
        $this->model->delete();

        // Return the Model
        return $this->model;
    }
}
