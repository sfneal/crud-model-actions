<?php


namespace Sfneal\CrudModelActions\Utils;


use Illuminate\Database\Eloquent\Model;
use Sfneal\Models\AbstractModel;
use Support\Tracking\Events\TrackActivityEvent;

trait ModelEvents
{
    /**
     * @var string Tracking Event to fire
     */
    protected $trackingEvent = TrackActivityEvent::class;

    /**
     * @var AbstractModel|Model
     */
    private $trackingEventModel;

    /**
     * Fire the trackingEvent
     *
     * @return void
     */
    protected function fireEvent()
    {
        event(new $this->trackingEvent($this->trackingEventModel()));
    }

    /**
     * Retrieve the Model to be used in the fireEvent() method
     *
     *  - optionally set a the $trackingEventModel property
     *  - useful for using a different model in the trackingEvent than the resolved/saved model
     *
     * @param Model|null $model
     * @return AbstractModel|Model
     */
    protected function trackingEventModel(Model $model = null): Model
    {
        if (isset($model)) {
            $this->trackingEventModel = $model;
        }

        return $this->trackingEventModel ?? $this->model;
    }
}
