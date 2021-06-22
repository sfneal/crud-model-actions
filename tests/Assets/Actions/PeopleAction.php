<?php


namespace Sfneal\CrudModelActions\Tests\Assets\Actions;


use Sfneal\CrudModelActions\CrudModelAction;
use Sfneal\CrudModelActions\Tests\Assets\Events\MockTrackingEvent;
use Sfneal\Testing\Models\People;

abstract class PeopleAction extends CrudModelAction
{
    /**
     * @var People
     */
    protected $model;

    /**
     * The Eloquent Model class.
     *
     * @var People
     */
    protected $modelClass = People::class;

    /**
     * @var MockTrackingEvent Model Tracking Event to fire
     */
    protected $trackingEvent = MockTrackingEvent::class;
}
