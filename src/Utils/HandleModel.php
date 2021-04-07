<?php

namespace Sfneal\CrudModelActions\Utils;

use Illuminate\Database\Eloquent\Model as EloquentModel;

// todo: refactor to interface
trait HandleModel
{
    /**
     * Save or update the Model.
     *
     * @return EloquentModel
     */
    abstract protected function handle(): EloquentModel;
}
