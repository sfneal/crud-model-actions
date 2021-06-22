<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Events;


use Illuminate\Database\Eloquent\Model;
use Sfneal\Events\Event;

class MockTrackingEvent extends Event
{
    /**
     * @var Model
     */
    private $model;

    /**
     * MockTrackingEvent constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
