<?php


namespace Sfneal\CrudModelActions\Interfaces;


interface CrudValidator
{
    /**
     * Confirm that the Project model has a Portfolio item
     *
     * @return bool
     */
    public function validate(): bool;
}
