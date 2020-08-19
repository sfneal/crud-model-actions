<?php


namespace Sfneal\CrudModelActions\Utils;


use Illuminate\Database\Eloquent\Model;

trait HandleModel
{
    /**
     * Save or update the Model
     *
     * @return Model
     */
    abstract protected function handle(): Model;
}
