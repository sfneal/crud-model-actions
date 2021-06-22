<?php

namespace Sfneal\CrudModelActions\Interfaces;

trait CrudFailResponder
{
    /**
     * Return the default error response.
     *
     * @return string
     */
    abstract protected function failResponse(): string;
}
