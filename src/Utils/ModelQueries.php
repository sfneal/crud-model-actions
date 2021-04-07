<?php

namespace Sfneal\CrudModelActions\Utils;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Model;

trait ModelQueries
{
    /**
     * @var Model|EloquentModel
     */
    protected $model;

    /**
     * The Eloquent Model class.
     *
     * @var Model|EloquentModel
     */
    protected $modelClass;

    /**
     * @var int|null
     */
    protected $related_model_key;

    /**
     * @var array Array of relationships that should be eager loaded with the model
     */
    protected $eagerLoadRelationships = [];

    /**
     * Set the $model property value.
     *
     *  - if an integer model_key value is passed, find the model
     *  - if a model instance is passed, declare the model
     *
     * @param int|EloquentModel|null $model
     * @return EloquentModel|null
     */
    private function resolveModel($model)
    {
        // todo: should there be a relatedModelClass or modelRelation attr?
        // $model is a Model class
        if ($model instanceof $this->modelClass) {
            return $model;
        }

        // Find the model using a model key
        else {
            return $this->modelQuery()->with($this->eagerLoadRelationships)->find($model);
        }
    }

    /**
     * Retrieve the Model's query builder.
     *
     * @return QueryBuilder|Builder
     */
    protected function modelQuery()
    {
        return $this->modelClass::query();
    }
}
